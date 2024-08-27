<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login - PDU Drilling System</title>

    <link href="{{asset('import/assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{asset('import/assets/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>
    <section class="vh-100" style="background-color: #9A616D;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="{{ asset('import/assets/img/drilling2.jpg') }}" alt="company well form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" object-fit: contain />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    @csrf
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                        <span class="h1 fw-bold mb-0">Company and Well</span>
                                    </div>

                                    <h5 class="fw-normal mb-3 pb-3"><b>Choose Company and Well</b></h5>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <label class="form-label" for="companyForm">Choose Company</label>
                                        <form class="user" id="companyForm">
                                            <div class="form-group">
                                                <select class="form-control" id="companySelect" required>
                                                    <option value="">Select Company</option>
                                                </select>
                                            </div>
                                        </form>
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <label class="form-label" for="wellSelect">Choose Well</label>
                                        <form class="user" id="wellForm">
                                            <div class="form-group">
                                                <select class="form-control" id="wellSelect" disabled required>
                                                    <option value="">Select Well</option>
                                                </select>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="pt-1 mb-4">
                                        <button id="submitSelection" class="btn btn-dark btn-lg btn-block" type="button">Go to Dashboard Monitoring</button>
                                    </div>
                                    <div class="pt-1 mb-4">
                                        <button id="backToLogin" class="btn btn-danger btn-lg btn-block" type="button">Back to Login</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{asset('import/assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('import/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('import/assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('import/assets/js/sb-admin-2.min.js')}}"></script>
    <script src="{{asset('assets/js/chooseCompanyWell.js')}}"></script>

</body>

</html>