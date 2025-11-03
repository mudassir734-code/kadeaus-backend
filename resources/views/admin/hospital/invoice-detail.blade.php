@extends('admin.layout.master')
@section('style')
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
        }

        .card {
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #eee;
            font-weight: bold;
            padding: 15px 20px;
        }

        .table th {
            border-top: none;
            font-weight: normal;
            color: #6c757d;
        }

        .btn-light {
            border: 1px solid #ddd;
        }

        .total-row {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .section-title {
            font-size: 1.1rem;
            margin-bottom: 15px;
            color: #495057;
        }

        .billing-overview .card-body {
            padding: 10px 15px;
        }

        .billing-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .form-control {
            background-color: #f8f9fa;
        }

        .insurance-section {
            background-color: #e9ecef;
        }
    </style>
@endsection
@section('content')
    <div class="container">
            <h1 class="mb-4">Patient Billing</h1>

            <div class="row">
                <!-- Left Column -->
                <div class="col-md-8">
                    <!-- Patient Info Card -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <span class="me-2">Patient ID</span>
                                        <input type="text" class="form-control form-control-sm d-inline-block w-50"
                                            value="IVN01">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="inpatientCheck" checked>
                                        <label class="form-check-label" for="inpatientCheck">Inpatient</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <span class="me-2">Room</span>
                                        <input type="text" class="form-control form-control-sm d-inline-block w-50"
                                            value="304.Bed B">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-select form-select-sm">
                                        <option selected>Select Patient</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Billing Table -->
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Total Amount</span>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-sm mb-0">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>09/21/2024</td>
                                        <td>Lab Test</td>
                                        <td>1</td>
                                        <td>$ 20</td>
                                    </tr>
                                    <tr>
                                        <td>09/21/2024</td>
                                        <td>Medication</td>
                                        <td>3</td>
                                        <td>$ 60</td>
                                    </tr>
                                    <tr class="total-row">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>$ 80</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                            <button class="btn btn-light btn-sm">Add Row</button>
                            <div>
                                <strong>Grand Total: $160</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Generate Invoice Button -->
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary">Generate Invoice</button>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-4">
                    <!-- Billing Overview -->
                    <div class="card mb-4 billing-overview">
                        <div class="card-header">Billing Overview</div>
                        <div class="card-body">
                            <div class="billing-item">
                                <span>Medications</span>
                                <span>$100</span>
                            </div>
                            <div class="billing-item">
                                <span>Lab Tests</span>
                                <span>$50</span>
                            </div>
                            <div class="billing-item">
                                <span>Procedures</span>
                                <span>$80</span>
                            </div>
                            <hr>
                            <div class="billing-item">
                                <span>Total Amount</span>
                                <span>$180</span>
                            </div>
                            <div class="billing-item">
                                <span>Outstanding Dues</span>
                                <span>$10</span>
                            </div>
                            <div class="billing-item">
                                <span>Refund</span>
                                <span>$0.00</span>
                            </div>
                        </div>
                    </div>

                    <!-- Add Advance Payment -->
                    <div class="card mb-4">
                        <div class="card-header">Add Advance Payment</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Amount</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mode</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Date</label>
                                <input type="text" class="form-control" placeholder="DD/MM/YY">
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-primary">Add Payment</button>
                            </div>
                        </div>
                    </div>

                    <!-- Insurance Billing -->
                    <div class="card insurance-section">
                        <div class="card-header">Insurance Billing</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">City Insurance Company</label>
                                <input type="text" class="form-control" value="Insurance ID: Approved">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Co-Pay</label>
                                <input type="text" class="form-control" value="$134">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deductible</label>
                                <input type="text" class="form-control" value="$134">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('script')
    
@endsection