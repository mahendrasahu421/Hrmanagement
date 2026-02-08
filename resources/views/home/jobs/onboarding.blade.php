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

        .dataTables_paginate {
            margin-bottom: 15px;
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

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
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

        .workflow::after {
            content: '';
            position: absolute;
            top: 40%;
            left: 93px;
            height: 4px;
            background: #ff6b00;
            z-index: 1;
            transform: translateY(-50%);
            border-radius: 2px;
            width: var(--workflow-green, 0%);
            transition: width 0.5s ease;
        }

        .workflow-step {
            text-align: center;
            position: relative;
            flex: 1;
            z-index: 2;
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
            background: #ff6b00;
        }

        .workflow-step.active .step-icon {
            background: #ff6b00;
            margin-top: 5px !important;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }


        .workflow-step p {
            font-weight: 600;
            margin: 5px 0 0;
            font-size: 15px;
            color: #1a1a1a;
        }

        @media (max-width: 768px) {
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

            .workflow::after {
                top: 0;
                left: 50%;
                width: 4px !important;
                height: var(--workflow-green, 0%);
                transform: translateX(-50%);
            }
        }

        tbody>tr td {
            padding: 5px !important;
        }

        .orange-radio {
            appearance: none;
            -webkit-appearance: none;
            width: 18px;
            height: 18px;
            border: 2px solid #ff6b00;
            border-radius: 50%;
            position: relative;
            cursor: pointer;
            outline: none;
            background: #fff;
            vertical-align: middle;
        }

        .orange-radio:checked {
            border-color: #ff6b00;
        }

        .orange-radio:checked::after {
            content: '';
            width: 10px;
            height: 10px;
            background: #ff6b00;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }


        .workflow-step.rejected .step-icon {
            background: #e74c3c !important;
        }

        .workflow-step.rejected p {
            color: #e74c3c;
        }

        .workflow.rejected::after {
            background: #e74c3c !important;
        }
    </style>

    <div class="page-wrapper">
        <div class="content">

            @if ($candidate)
                <div class="card mb-4 p-4">
                    <div class="row">

                        <!-- Profile Image + CV -->
                        <div class="col-md-2 text-center mb-3">

                            <div>
                                <img src="{{ $candidate && $candidate->candidate_image ? asset('storage/' . $candidate->candidate_image) : 'https://png.pngtree.com/png-vector/20231019/ourmid/pngtree-user-profile-avatar-png-image_10211467.png' }}"
                                    style="width:90px;height:110px;border-radius:0;border:4px solid #ff6b00;object-fit:contain;box-shadow:0 4px 10px rgba(0,0,0,0.15);"
                                    alt="Candidate Image" />

                            </div>

                            @if ($candidate->resume)
                                <div class="mt-3">
                                    <a href="{{ asset('storage/' . $candidate->resume) }}" target="_blank"
                                        style="display:inline-block;background: linear-gradient(135deg, #ff6b00, #ff9b00);color:#fff;padding:6px 18px;font-size:13px;border-radius:20px;font-weight:600;text-decoration:none;box-shadow:0 4px 10px rgba(0,0,0,0.12);">
                                        View CV
                                    </a>
                                </div>
                            @endif

                        </div>

                        <!-- Candidate Details -->
                        <div class="col-md-9">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <tbody>

                                        <tr>
                                            <th width="180">Name</th>
                                            <td>{{ $candidate->first_name }} {{ $candidate->last_name }}</td>
                                            <th width="180">DOB</th>
                                            <td>{{ \Carbon\Carbon::parse($candidate->dob)->format('d-m-Y') }}</td>
                                        </tr>

                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $candidate->email }}</td>
                                            <th>State</th>
                                            <td>{{ $candidate->state->name ?? '-' }}</td>
                                        </tr>

                                        <tr>
                                            <th>City</th>
                                            <td>{{ $candidate->city->name ?? '-' }}</td>
                                            {{-- <th>Working With</th>
                                            <td>{{ $candidate->job->title ?? '-' }}</td> --}}
                                        </tr>

                                        <tr>
                                            <th>Skills</th>
                                            <td colspan="3">
                                                @if (!empty($candidate->skill_names))
                                                    @foreach ($candidate->skill_names as $skill)
                                                        <span class="badge bg-primary text-white me-1 mb-1">
                                                            {{ $skill }}
                                                        </span>
                                                    @endforeach
                                                @else
                                                    <span class="text-muted">No skills added</span>
                                                @endif

                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            @else
                <p class="text-danger">No candidate found.</p>
            @endif


            <!-- Workflow -->
            <div class="workflow">
                <div class="workflow-step completed">
                    <div class="step-icon" style="margin-top: 20px"><i class="fa-solid fa-file-alt"></i></div>
                    <p>Submission</p>
                    <small>
                        Date: {{ \Carbon\Carbon::parse($candidate->created_at)->format('d-m-Y') }}
                    </small>
                </div>

                <div class="workflow-step mt-3">
                    <div class="step-icon"><i class="fa-solid fa-check"></i></div>
                    <p>Shortlist</p>

                    @if (in_array($candidate->status, ['shortlisted', 'interview_scheduled', 'interview_postponed', 'selected', 'placed']))
                        <div class="mt-2">
                            <span class="badge bg-primary">Shortlisted</span>
                        </div>
                    @elseif($candidate->status === 'rejected')
                        <div class="mt-2">
                            <span class="badge bg-danger">Rejected</span>
                        </div>
                    @else
                        <div style="display: flex; gap: 20px; justify-content: center; margin-top: 5px;">
                            <div>
                                <input type="radio" name="shortlist" id="shortlisted" class="orange-radio">
                                <label for="shortlisted">Shortlisted</label>
                            </div>
                            <div>
                                <input type="radio" name="shortlist" id="not-shortlisted" class="orange-radio">
                                <label for="not-shortlisted">Not Shortlisted</label>
                            </div>
                        </div>
                    @endif
                </div>



                <div class="workflow-step">
                    <div class="step-icon"><i class="fa-solid fa-calendar-alt"></i></div>
                    <p>Interview</p>
                </div>

                <div class="workflow-step">
                    <div class="step-icon"><i class="fa-solid fa-file"></i></div>
                    <p>Confirmation Letter</p>
                </div>

                <div class="workflow-step">
                    <div class="step-icon"><i class="fa-solid fa-industry"></i></div>
                    <p>Placed</p>
                </div>
            </div>

            <!-- Interview Table -->
            <div class="row mt-5" id="interviewSection"
                style="{{ in_array($candidate->status, ['shortlisted', 'interview_scheduled', 'interview_postponed', 'selected']) ? '' : 'display:none;' }}">

                <div class="col-sm-12">
                    <div class="card">

                        <div class="card-header">
                            <h4 class="card-title">Interview Schedule</h4>
                        </div>

                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table datatable w-100">

                                    <thead class="thead-light">
                                        <tr>
                                            <th>Round</th>
                                            <th>Mode</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Venue</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Comments</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody id="interviewBody">
                                        @foreach ($candidate->interviewSchedules as $schedule)
                                            <tr data-id="{{ $schedule->id }}">
                                                <td>
                                                    <input type="text" class="form-control round"
                                                        value="{{ $schedule->round }}"
                                                        {{ $schedule->id ? 'disabled' : '' }}>
                                                </td>

                                                <td>
                                                    <select class="form-control mode select2"
                                                        {{ $schedule->id ? 'disabled' : '' }}>
                                                        <option value="">Select Mode</option>
                                                        <option value="offline"
                                                            {{ $schedule->mode == 'offline' ? 'selected' : '' }}>Offline
                                                        </option>
                                                        <option value="online"
                                                            {{ $schedule->mode == 'online' ? 'selected' : '' }}>Online
                                                        </option>
                                                        <option value="on_call"
                                                            {{ $schedule->mode == 'on_call' ? 'selected' : '' }}>On Call
                                                        </option>
                                                    </select>
                                                </td>

                                                <td>
                                                    <input type="date" class="form-control date"
                                                        value="{{ $schedule->date }}"
                                                        {{ $schedule->id ? 'disabled' : '' }}>
                                                </td>

                                                <td>
                                                    <input type="time" class="form-control time"
                                                        value="{{ $schedule->time }}"
                                                        {{ $schedule->id ? 'disabled' : '' }}>
                                                </td>

                                                <td>
                                                    <textarea class="form-control venue" rows="2" {{ $schedule->id ? 'disabled' : '' }}>{{ $schedule->venue }}</textarea>
                                                </td>

                                                <td>
                                                    <textarea class="form-control description" rows="2" {{ $schedule->id ? 'disabled' : '' }}>{{ $schedule->description }}</textarea>
                                                </td>

                                                <td>
                                                    <select class="form-control status select2"
                                                        {{ $schedule->id ? '' : 'disabled' }}>
                                                        <option value="">Select Status</option>
                                                        <option value="cleared"
                                                            {{ $schedule->status == 'cleared' ? 'selected' : '' }}>Cleared
                                                        </option>
                                                        <option value="rejected"
                                                            {{ $schedule->status == 'rejected' ? 'selected' : '' }}>
                                                            Rejected</option>
                                                        <option value="postponed"
                                                            {{ $schedule->status == 'postponed' ? 'selected' : '' }}>
                                                            Postponed</option>
                                                    </select>
                                                </td>

                                                <td>
                                                    <textarea class="form-control comments" rows="2" {{ $schedule->id ? '' : 'disabled' }}>{{ $schedule->comments }}</textarea>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm saveBtn">
                                                        {{ $schedule->id ? 'Update' : 'Save' }}
                                                    </button>

                                                </td>
                                            </tr>
                                        @endforeach

                                        @if ($candidate->interviewSchedules->isEmpty())
                                            <tr>
                                                <td><input type="text" class="form-control round" value="R1"></td>

                                                <td>
                                                    <select class="form-control mode">
                                                        <option value="">Select Mode</option>
                                                        <option value="offline">Offline</option>
                                                        <option value="online">Online</option>
                                                        <option value="on_call">On Call</option>
                                                    </select>
                                                </td>

                                                <td><input type="date" class="form-control date"></td>
                                                <td><input type="time" class="form-control time"></td>

                                                <td>
                                                    <textarea class="form-control venue" rows="2"></textarea>
                                                </td>

                                                <td>
                                                    <textarea class="form-control description" rows="2"></textarea>
                                                </td>

                                                <td>
                                                    <select class="form-control status" disabled>
                                                        <option value="">Select Status</option>
                                                        <option value="cleared">Cleared</option>
                                                        <option value="rejected">Rejected</option>
                                                        <option value="postponed">Postponed</option>
                                                    </select>
                                                </td>

                                                <td>
                                                    <textarea class="form-control comments" rows="2" disabled></textarea>
                                                </td>

                                                <td>
                                                    <button class="btn btn-info btn-sm saveBtn">Save</button>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>


                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-footer />
        <!-- Shortlist Modal -->
        <div class="modal fade" id="shortlist_modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <span class="avatar avatar-xl bg-transparent-success text-success mb-3">
                            <i class="ti ti-check fs-36"></i>
                        </span>
                        <h4 class="mb-1">Confirm Action</h4>
                        <p class="mb-3" id="shortlistMessage">Are you sure?</p>
                        <input type="hidden" id="shortlistStatus">
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" id="confirmShortlistBtn" class="btn btn-success">Yes, Proceed</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="saveConfirmModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4">
                    <div class="modal-body text-center p-4">
                        <div class="mb-3">
                            <span
                                class="avatar avatar-xl bg-warning-subtle text-warning rounded-circle d-inline-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-circle-question fs-2"></i>
                            </span>
                        </div>

                        <h4 class="mb-2 fw-bold">Confirm Action</h4>
                        <p class="text-muted mb-4">
                            Are you sure you want to save / update this interview?
                        </p>

                        <div class="d-flex justify-content-center gap-3">
                            <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="button" id="confirmSaveBtn" class="btn btn-primary px-4">
                                Yes, Proceed
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4">
                    <div class="modal-body text-center p-4">
                        <div class="mb-3">
                            <span
                                class="avatar avatar-xl bg-success-subtle text-success rounded-circle d-inline-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-circle-check fs-2"></i>
                            </span>
                        </div>

                        <h4 class="mb-2 fw-bold text-success">Success</h4>
                        <p class="text-muted mb-4">
                            Interview saved successfully and email sent.
                        </p>

                        <button type="button" class="btn btn-success px-4" data-bs-dismiss="modal">
                            OK
                        </button>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@push('after_scripts')
    <script>
    const candidateStatus = "{{ $candidate->status }}";
    const candidateId = "{{ $candidate->id }}";

    let pendingPayload = null;
    let pendingBtn = null;

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('saveBtn')) {
            e.preventDefault();

            const btn = e.target;
            const tr = btn.closest('tr');

            const data = {
                round: tr.querySelector('.round').value,
                mode: tr.querySelector('.mode').value,
                date: tr.querySelector('.date').value,
                time: tr.querySelector('.time').value,
                venue: tr.querySelector('.venue').value,
                description: tr.querySelector('.description').value,
                status: tr.querySelector('.status').value,
                comments: tr.querySelector('.comments').value,
            };

            const scheduleId = tr.dataset.id;
            const url = scheduleId ?
                `/onboarding/interview-status/${scheduleId}` :
                `/onboarding/${candidateId}/interview-schedule`;

            pendingPayload = {
                btn,
                tr,
                data,
                scheduleId,
                url
            };
            pendingBtn = btn;

            const confirmModal = new bootstrap.Modal(document.getElementById('saveConfirmModal'));
            confirmModal.show();
        }
    });

    document.getElementById('confirmSaveBtn').addEventListener('click', function() {
        if (!pendingPayload) return;

        const confirmBtn = this;
        const originalText = confirmBtn.innerText;

        // 👉 change Yes, Proceed to Sending...
        confirmBtn.disabled = true;
        confirmBtn.innerText = 'Sending...';

        const {
            btn,
            tr,
            data,
            scheduleId,
            url
        } = pendingPayload;

        btn.disabled = true;
        btn.innerText = 'Saving...';

        fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(data)
            })
            .then(async res => {
                if (!res.ok) {
                    const text = await res.text();
                    throw new Error(text);
                }
                return res.json();
            })
            .then(res => {
                if (res.success) {
                    if (
                        data.status === 'postponed' &&
                        !tr.dataset.newRowAdded &&
                        res.candidate_status === 'interview_postponed'
                    ) {
                        const allRounds = Array.from(document.querySelectorAll('.round'))
                            .map(r => parseInt(r.value.replace('R', '')));
                        const nextRoundNumber = Math.max(...allRounds) + 1;

                        const newRow = `
                            <tr>
                                <td><input type="text" class="form-control round" value="R${nextRoundNumber}"></td>
                                <td>
                                    <select class="form-control mode">
                                        <option value="">Select Mode</option>
                                        <option value="offline">Offline</option>
                                        <option value="online">Online</option>
                                        <option value="on_call">On Call</option>
                                    </select>
                                </td>
                                <td><input type="date" class="form-control date"></td>
                                <td><input type="time" class="form-control time"></td>
                                <td><textarea class="form-control venue" rows="2"></textarea></td>
                                <td><textarea class="form-control description" rows="2"></textarea></td>
                                <td>
                                    <select class="form-control status" disabled>
                                        <option value="">Select Status</option>
                                        <option value="cleared">Cleared</option>
                                        <option value="rejected">Rejected</option>
                                        <option value="postponed">Postponed</option>
                                    </select>
                                </td>
                                <td><textarea class="form-control comments" rows="2" disabled></textarea></td>
                                <td><button class="btn btn-info btn-sm saveBtn">Save</button></td>
                            </tr>
                        `;

                        document.getElementById('interviewBody').insertAdjacentHTML('beforeend', newRow);
                        tr.querySelectorAll('input, select, textarea, button').forEach(el => el.disabled = true);
                        tr.dataset.newRowAdded = true;

                        btn.innerText = 'Saved';
                        const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                        successModal.show();
                        return;
                    }

                    const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                    successModal.show();

                    document.getElementById('successModal').addEventListener('hidden.bs.modal', function() {
                        window.location.reload();
                    });

                } else {
                    alert('Something went wrong!');
                    btn.disabled = false;
                    btn.innerText = scheduleId ? 'Update' : 'Save';
                }
            })
            .catch(err => {
                console.error(err);
                alert('Error! Check console.');
                btn.disabled = false;
                btn.innerText = scheduleId ? 'Update' : 'Save';
            })
            .finally(() => {
                // restore confirm button text
                confirmBtn.disabled = false;
                confirmBtn.innerText = originalText;

                const cm = bootstrap.Modal.getInstance(document.getElementById('saveConfirmModal'));
                if (cm) cm.hide();
                pendingPayload = null;
            });
    });
</script>




    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const steps = document.querySelectorAll('.workflow-step');
            const workflow = document.querySelector('.workflow');
            let candidateStatus = "{{ $candidate->status }}";
            const statusMap = {
                applied: 1,
                shortlisted: 2,
                interview_scheduled: 3,
                interview_postponed: 3,
                selected: 4,
                placed: 5,
                rejected: 2
            };

            function renderWorkflow(status) {
                const currentLevel = statusMap[status] || 1;
                steps.forEach(step => {
                    step.classList.remove('completed', 'active', 'rejected');
                });
                if (status !== 'rejected') {
                    steps.forEach((step, index) => {
                        const stepNumber = index + 1;
                        if (stepNumber < currentLevel) {
                            step.classList.add('completed');
                        } else if (stepNumber === currentLevel) {
                            step.classList.add('active');
                        }
                    });
                    const percentMap = {
                        1: 0,
                        2: 22,
                        3: 44,
                        4: 62,
                        5: 100
                    };
                    let percent = percentMap[currentLevel] ?? 0;
                    workflow.style.setProperty('--workflow-green', percent + '%');
                } else {
                    steps[0].classList.add('completed');
                    const rejectedStep = steps[1];
                    rejectedStep.classList.add('rejected');
                    const icon = rejectedStep.querySelector('.step-icon i');
                    if (icon) {
                        icon.className = 'fa-solid fa-xmark';
                    }
                    workflow.classList.add('rejected');
                    workflow.style.setProperty('--workflow-green', '22%');
                }
            }
            renderWorkflow(candidateStatus);
            const shortlistModal = new bootstrap.Modal(document.getElementById('shortlist_modal'));
            const shortlistMessage = document.getElementById('shortlistMessage');
            const shortlistRadio = document.getElementById('shortlisted');
            const notShortlistRadio = document.getElementById('not-shortlisted');
            const interviewSection = document.getElementById('interviewSection');
            let selectedStatus = null;
            shortlistRadio.addEventListener('click', function(e) {
                e.preventDefault();
                shortlistMessage.textContent = "Are you sure you want to shortlist this candidate?";
                selectedStatus = "shortlisted";
                shortlistModal.show();
            });
            notShortlistRadio.addEventListener('click', function(e) {
                e.preventDefault();
                shortlistMessage.textContent = "Are you sure you want to mark as not shortlisted?";
                selectedStatus = "rejected";
                shortlistModal.show();
            });
            document.getElementById('confirmShortlistBtn').addEventListener('click', function() {
                const btn = this;
                btn.disabled = true;
                btn.innerText = "Sending Email...";
                fetch("{{ route('onboarding.shortlist', $candidate->id) }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            status: selectedStatus
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            window.location.reload();
                        } else {
                            alert("Something went wrong!");
                        }
                    })
                    .catch(err => {
                        alert("Something went wrong!");
                    })
                    .finally(() => {
                        btn.disabled = false;
                        btn.innerText = "Yes, Proceed";
                    });
            });

        });
    </script>
@endpush
