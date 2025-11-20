@extends('employee.layout.layout')
@section('title', $title)
@section('main-section')

    <x-alert-modal />

    <div class="page-wrapper" style="min-height: 428px;">
        <div class="content">

            <!-- Page Header -->
            <div class="mb-4">
                <h4 class="mb-2">Form C</h4>
                <h5 class="mb-3 text-muted">फॉर्म सी</h5>
            </div>

            <!-- Achievements Section -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <div class="btn-primary p-2">
                        <h5 class="mb-2 text-white">1. Top 3 Achievements during performance assessment year</h5>
                        <h6 class="text-white">1. प्रदर्शन मूल्यांकन वर्ष के दौरान शीर्ष 3 उपलब्धियाँ</h6>
                    </div>

                    <!-- Achievement 1 -->
                    <div class="achievement-group mt-3">
                        <p>Achievement 1 / उपलब्धि 1</p>
                        <textarea class="form-control achievement" rows="2" maxlength="500">In the Jandaha Branch, there was no Loan Disbursement for the Past 8 Months, however, after i joined, over 30 loans have been Disbursed every month, I have worked collaboratively with my team to achieve the Target in my area. this includes completing the loan dis. target on time and continuously improving departmental performance.</textarea>
                        <small class="text-muted charCount">500 characters left</small>
                    </div>

                    <!-- Achievement 2 -->
                    <div class="achievement-group mt-3">
                        <p>Achievement 2 / उपलब्धि 2</p>
                        <textarea class="form-control achievement" rows="2" maxlength="500">we have complete control over the BM and Staff in our area to ensure that no one breaks the Company rule & that no theft occurs. this has maintained trust and transparency within the organization.</textarea>
                        <small class="text-muted charCount">500 characters left</small>
                    </div>

                    <!-- Achievement 3 -->
                    <div class="achievement-group mt-3">
                        <p>Achievement 3 / उपलब्धि 3</p>
                        <textarea class="form-control achievement" rows="2" maxlength="500"> i have implement new strategies to improve workflows and operations across various branches ,which has positively impacted and achievement of our target .</textarea>
                        <small class="text-muted charCount">500 characters left</small>
                    </div>

                </div>

                <div class="card-body">
                    <div class="btn-primary p-2">
                        <h5 class="mb-2 text-white">2.What I could have done better during performance assessment year</h5>
                        <h6 class="text-white">प्रदर्शन मूल्यांकन वर्ष के दौरान मैं क्या बेहतर कर सकता था</h6>
                    </div>

                    <!-- Activity 1 -->
                    <div class="achievement-group mt-3">
                        <p>Activity 1 / गतिविधि 1</p>
                        <textarea class="form-control achievement" rows="2" maxlength="500">i could have managed my responsibilities more efficiently and prioritized my tasks better .</textarea>
                        <small class="text-muted charCount">500 characters left</small>
                    </div>

                    <!-- Activity 2 -->
                    <div class="achievement-group mt-3">
                        <p>Activity 2 / गतिविधि 2</p>
                        <textarea class="form-control achievement" rows="2" maxlength="500">i could have worked on enhancing clarity and effectiveness in communicating with my team and other department .</textarea>
                        <small class="text-muted charCount">500 characters left</small>
                    </div>

                    <!-- Activity 3 -->
                    <div class="achievement-group mt-3">
                        <p>Activity 3 / गतिविधि 3</p>
                        <textarea class="form-control achievement" rows="2" maxlength="500"> i could have been more proactive in acquiring new skills and technologies, which would have further improved my work efficiency.</textarea>
                        <small class="text-muted charCount">500 characters left</small>
                    </div>

                </div>

                <div class="card-body">
                    <div class="btn-primary p-2">
                        <h5 class="mb-2 text-white">3.My improvement goals for next year</h5>
                        <h6 class="text-white">अगले वर्ष के लिए मेरे सुधार लक्ष्य</h6>
                    </div>

                    <!-- Goal 1 -->
                    <div class="achievement-group mt-3">
                        <p>Goal 1 / लक्ष्य 1</p>
                        <textarea class="form-control achievement" rows="2" maxlength="500">At the Branch in our Area ,we will work together with the team to reduce the Par % .</textarea>
                        <small class="text-muted charCount">500 characters left</small>
                    </div>

                    <!-- Goal 2 -->
                    <div class="achievement-group mt-3">
                        <p>Goal 2 / लक्ष्य 2</p>
                        <textarea class="form-control achievement" rows="2" maxlength="500">I will work with my team in my area to meet the loan Dis. target by the Company .</textarea>
                        <small class="text-muted charCount">500 characters left</small>
                    </div>

                    <!-- Goal 3 -->
                    <div class="achievement-group mt-3">
                        <p>Goal 3 / लक्ष्य 3</p>
                        <textarea class="form-control achievement" rows="2" maxlength="500">In the Gaunaha Branch ,there was only 1 GM & No BM ,but have added three more GMs & 1 BM there ,Additionally ,we have had 1 GM Join in sasamusa & 1 GM join in the Tamkuhi Branch ,Moving forward ,we will have over five GMs in all our Braanches .</textarea>
                        <small class="text-muted charCount">500 characters left</small>
                    </div>

                </div>

                <div class="card-body">
                    <div class="btn-primary p-2">
                        <h5 class="mb-2 text-white">Training</h5>
                    </div>

                    <div class="dropdown w-100 position-relative">
                        <button class="btn btn-light w-100 text-start no-caret text-black bg-white mt-3" type="button"
                            id="trainingMenu" data-bs-toggle="dropdown" data-bs-display="static">
                            Select
                        </button>

                        <ul class="dropdown-menu w-100 dropdown-menu-bottom p-2" aria-labelledby="trainingMenu">
                            <input type="text" id="searchTraining" class="form-control mb-2" placeholder="Search...">

                            <li><a class="dropdown-item training-item" href="#">Add Training</a></li>
                            <li><a class="dropdown-item training-item" href="#">View All</a></li>
                            <li><a class="dropdown-item training-item" href="#">Export</a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <x-footer />
    </div>

@endsection

@push('after_scripts')
    <script>
        document.getElementById('searchTraining').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let items = document.querySelectorAll('.training-item');

            items.forEach(item => {
                let text = item.textContent.toLowerCase();
                item.style.display = text.includes(filter) ? "block" : "none";
            });
        });
    </script>

    <script>
        document.querySelectorAll('.achievement-group').forEach(group => {
            const textarea = group.querySelector('.achievement');
            const counter = group.querySelector('.charCount');

            function updateCount() {
                const remaining = 500 - textarea.value.length;
                counter.textContent = remaining + ' characters left';
            }

            updateCount();
            textarea.addEventListener('input', updateCount);
        });
    </script>
@endpush
