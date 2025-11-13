@extends('layout.master')
@section('title', $title)

@section('main-section')
    <style>
        .candidate-card {
            padding: 30px;
            border-radius: 30px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
            margin-bottom: 50px;
            display: flex;
            gap: 40px;
            overflow: hidden;
            transition: transform 0.4s, box-shadow 0.4s;
            flex-wrap: wrap;
        }

        .candidate-left {
            flex: 0 0 150px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .candidate-profile {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            border: 5px solid #ff6b00;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            margin-bottom: 15px;
        }

        .candidate-profile img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .candidate-right {
            flex: 1;
        }

        .candidate-right h3 {
            font-size: 28px;
            font-weight: 800;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .candidate-right a {
            display: inline-block;
            font-size: 14px;
            color: #ff9b00;
            margin-bottom: 20px;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .candidate-right a:hover {
            color: #ff6b00;
        }

        .candidate-info {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px 30px;
            font-size: 15px;
            color: #555;
            margin-top: 10px;
        }

        .candidate-info div strong {
            display: inline-block;
            width: 140px;
            font-weight: 600;
            color: #34495e;
        }

        .skill-cell {
            grid-column: span 2;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
        }

        .skill-badge {
            display: inline-block;
            background: linear-gradient(135deg, #ff6b00, #ff9b00);
            color: #fff;
            font-size: 13px;
            font-weight: 500;
            padding: 5px 12px;
            border-radius: 20px;
            margin-right: 6px;
            margin-top: 4px;
            animation: badgePulse 2s infinite;
        }

        @keyframes badgePulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .workflow {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .workflow::before {
            content: '';
            position: absolute;
            top: 40%;
            left: 115px;
            right: 115px;
            height: 4px;
            background: #e0e0e0;
            z-index: 0;
            transform: translateY(-50%);
            border-radius: 2px;
        }

        .workflow-step {
            text-align: center;
            position: relative;
            flex: 1;
            z-index: 1;
            transition: transform 0.3s;
        }

        .workflow-step .step-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: #bdc3c7;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px auto;
            font-size: 24px;
            transition: background 0.3s, transform 0.3s;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .workflow-step.completed .step-icon {
            background: #3498db;
        }

        .workflow-step.active .step-icon {
            background: #1abc9c;
            margin-top: 25px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .workflow-step p {
            font-weight: 600;
            margin: 5px 0 0;
            font-size: 15px;
            color: #1a1a1a;
        }

        .workflow-step small {
            display: block;
            margin-top: 3px;
            font-weight: 400;
            font-size: 13px;
            color: #888;
        }

        .workflow-step input[type="radio"] {
            display: none;
        }

        .workflow-step label {
            position: relative;
            padding-left: 28px;
            cursor: pointer;
            user-select: none;
            font-weight: 500;
            color: #333;
        }

        .workflow-step label::before {
            content: "";
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            border: 2px solid #ff6b00;
            border-radius: 50%;
            background: #fff;
            transition: all 0.3s;
        }

        .workflow-step input[type="radio"]:checked + label::after {
            content: "";
            position: absolute;
            left: 5px;
            top: 50%;
            transform: translateY(-50%);
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #ff6b00;
        }

        .btn.btn-success {
            background: #ff6b00 !important;
            border: 1px solid #ff6b00 !important;
        }
        .completed{
            margin-top: 15px !important;
        }

        @media (max-width: 768px) {
            .candidate-card {
                flex-direction: column;
                align-items: center;
            }

            .candidate-left {
                margin-bottom: 20px;
            }

            .candidate-info {
                grid-template-columns: 1fr;
            }

            .workflow {
                flex-direction: column;
                align-items: center;
            }

            .workflow::before {
                top: 0;
                left: 50%;
                width: 4px;
                height: 100%;
                transform: translateX(-50%);
            }

            .workflow-step {
                margin-bottom: 40px;
            }
        }
    </style>

    <div class="page-wrapper">
        <div class="content">
            <!-- Candidate Card -->
            <div class="candidate-card">
                <div class="candidate-left">
                    <div class="candidate-profile">
                        <img src="https://randomuser.me/api/portraits/men/41.jpg" alt="Rohit Mishra">
                    </div>
                </div>

                <div class="candidate-right">
                    <h3>Rohit Mishra</h3>
                    <a href="#">View CV</a>

                    <div class="candidate-info">
                        <div><strong>DOB:</strong> 04-03-2005</div>
                        <div><strong>State:</strong> Karnataka</div>
                        <div><strong>Email:</strong> rohitmishra41@gmail.com</div>
                        <div><strong>City:</strong> Bangalore</div>

                        <div class="skill-cell">
                            <strong>Skill:</strong>
                            <span class="skill-badge">Research</span>
                            <span class="skill-badge">Documentation</span>
                            <span class="skill-badge">Communication</span>
                        </div>

                        <div><strong>Working with:</strong> Communities and Children</div>
                    </div>
                </div>
            </div>

            <!-- Workflow -->
            <div class="workflow">
                <div class="workflow-step completed">
                    <div class="step-icon">
                        <i class="fa-solid fa-file-alt"></i>
                    </div>
                    <p>Submission</p>
                    <small>Date: 2025-11-12</small>
                </div>

                <div class="workflow-step active">
                    <div class="step-icon">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <p>Shortlist</p>
                    <div style="display: flex; gap: 20px; justify-content: center; margin-top: 5px;">
                        <div>
                            <input type="radio" name="shortlist" id="shortlisted">
                            <label for="shortlisted">Shortlisted</label>
                        </div>
                        <div>
                            <input type="radio" name="shortlist" id="not-shortlisted">
                            <label for="not-shortlisted">Not Shortlisted</label>
                        </div>
                    </div>
                </div>

                <div class="workflow-step">
                    <div class="step-icon">
                        <i class="fa-solid fa-calendar-alt"></i>
                    </div>
                    <p>Interview</p>
                </div>

                <div class="workflow-step">
                    <div class="step-icon">
                        <i class="fa-solid fa-file"></i>
                    </div>
                    <p>Confirmation Letter</p>
                </div>

                <div class="workflow-step">
                    <div class="step-icon">
                        <i class="fa-solid fa-industry"></i>
                    </div>
                    <p>Placed</p>
                </div>
            </div>
        </div>

        <x-footer />

        <!-- Shortlist Confirmation Modal -->
        <div class="modal fade" id="shortlist_modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <span class="avatar avatar-xl bg-transparent-success text-success mb-3">
                            <i class="ti ti-check fs-36"></i>
                        </span>
                        <h4 class="mb-1">Confirm Action</h4>
                        <p class="mb-3" id="shortlistMessage">Are you sure you want to shortlist this candidate?</p>
                        <input type="hidden" id="shortlistStatus">
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" id="confirmShortlistBtn" class="btn btn-success">Yes, Proceed</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('after_scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const shortlistRadio = document.getElementById('shortlisted');
        const notShortlistRadio = document.getElementById('not-shortlisted');
        const shortlistModal = new bootstrap.Modal(document.getElementById('shortlist_modal'));
        const shortlistMessage = document.getElementById('shortlistMessage');
        const shortlistStatus = document.getElementById('shortlistStatus');

        let selectedRadio = null;

        shortlistRadio.addEventListener('click', function(e) {
            e.preventDefault();
            selectedRadio = shortlistRadio;
            shortlistMessage.textContent = "Are you sure you want to shortlist this candidate?";
            shortlistStatus.value = "shortlisted";
            shortlistModal.show();
        });

        notShortlistRadio.addEventListener('click', function(e) {
            e.preventDefault();
            selectedRadio = notShortlistRadio;
            shortlistMessage.textContent = "Are you sure you want to mark this candidate as not shortlisted?";
            shortlistStatus.value = "not_shortlisted";
            shortlistModal.show();
        });

        document.getElementById('confirmShortlistBtn').addEventListener('click', function() {
            const status = shortlistStatus.value;

            if (selectedRadio) selectedRadio.checked = true;

            const stepIcon = document.querySelector('.workflow-step.active .step-icon');
            stepIcon.classList.add('completed');

            console.log("Candidate status:", status);

            shortlistModal.hide();
        });
    });
</script>
@endpush
