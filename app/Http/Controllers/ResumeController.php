<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;
use PhpOffice\PhpWord\IOFactory;
class ResumeController extends Controller
{
    public function parse(Request $request)
    {
        $request->validate([
            'resume' => 'required|mimes:pdf,doc,docx|max:2048'
        ]);

        $file = $request->file('resume');
        $text = '';

        // PDF
        if ($file->getClientOriginalExtension() === 'pdf') {
            $parser = new Parser();
            $pdf = $parser->parseFile($file->getPathname());
            $text = $pdf->getText();
        }

        // DOC / DOCX
        if (in_array($file->getClientOriginalExtension(), ['doc', 'docx'])) {
            $phpWord = IOFactory::load($file->getPathname());
            foreach ($phpWord->getSections() as $section) {
                foreach ($section->getElements() as $element) {
                    if (method_exists($element, 'getText')) {
                        $text .= $element->getText() . ' ';
                    }
                }
            }
        }

        // -------- Extract Data (Basic Regex) --------
        preg_match('/[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}/i', $text, $email);
        preg_match('/(\+91[\-\s]?)?[0]?[6789]\d{9}/', $text, $phone);

        $lines = preg_split('/\r\n|\r|\n/', trim($text));
        $name = $lines[0] ?? '';

        return response()->json([
            'name' => trim($name),
            'email' => $email[0] ?? '',
            'phone' => $phone[0] ?? '',
        ]);
    }
}
