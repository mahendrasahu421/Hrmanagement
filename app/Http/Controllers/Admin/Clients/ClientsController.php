<?php

namespace App\Http\Controllers\Admin\Clients;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use function PHPUnit\Framework\returnArgument;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Current data
        $totalClients = Client::count();
        $activeClients = Client::where('status', 'Active')->count();
        $inactiveClients = Client::where('status', 'Inactive')->count();
        $newClients = Client::where('created_at', '>=', now()->subDays(30))->count();

        // Previous period (example: pichle 30 din)
        $previousTotalClients = Client::where('created_at', '<', now()->subDays(30))->count();
        $previousActiveClients = Client::where('status', 'Active')
            ->where('created_at', '<', now()->subDays(30))
            ->count();
        $previousInactiveClients = Client::where('status', 'Inactive')
            ->where('created_at', '<', now()->subDays(30))
            ->count();
        $previousNewClients = Client::whereBetween('created_at', [now()->subDays(60), now()->subDays(30)])
            ->count();

        // Growth calculation function
        $calculateGrowth = function ($current, $previous) {
            if ($previous == 0) {
                return $current > 0 ? 100 : 0;
            }
            return round((($current - $previous) / $previous) * 100, 2);
        };

        // Clients list with pagination
        $clients = Client::latest()->paginate(10);

        // Growth values
        $data = [
            'totalClients' => $totalClients,
            'activeClients' => $activeClients,
            'inactiveClients' => $inactiveClients,
            'newClients' => $newClients,
            'growthTotalClients' => $calculateGrowth($totalClients, $previousTotalClients),
            'growthActiveClients' => $calculateGrowth($activeClients, $previousActiveClients),
            'growthInactiveClients' => $calculateGrowth($inactiveClients, $previousInactiveClients),
            'growthNewClients' => $calculateGrowth($newClients, $previousNewClients),
            'clients' => $clients,
            'title' => 'Clients',
            'imageUrl' => "https://picsum.photos/200/200?random=" . rand(1, 1000),
        ];

        // Agar ajax request aayi hai to sirf partial client list return karenge
        if ($request->ajax()) {
            return view('admin.client.partials.client-list', compact('clients'))->render();
        }

        // Normal request me full page
        return view('admin.client.index', $data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'username' => 'required|string|max:255|unique:clients,username',
            'email' => 'required|email|max:255|unique:clients,email',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|string|max:20',
            'company_name' => 'nullable|string|max:255',
            'profile' => 'nullable|image|max:4096',
        ]);

        try {
            $imagePath = null;

            if ($request->hasFile('profile')) {
                $imagePath = $request->file('profile')->store('clients', 'public');
            }

            Client::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'company_name' => $request->company_name,
                'profile' => $imagePath,
            ]);

            return redirect()->route('admin.clients')
                ->with('success', 'Client created successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */


    public function show($id)
    {
        try {
            $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
            $data['title'] = "Client Details";
            $data['client'] = Client::findOrFail($id);

            return view('admin.client.clients-details', $data);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.clients')
                ->with('error', 'Client not found.');
        } catch (\Exception $e) {
            return redirect()->route('admin.clients')
                ->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
