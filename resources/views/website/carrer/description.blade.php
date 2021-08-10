@extends('layouts.master')
@section('title','Explore career opportunity with us')
@section('content')
	<section class="JDtext text-center">
        <div class="container">
            <h4>Database Administrator</h4>
            <span>REMOTE</span>
            <p>Partner Solutions Group, Partner Success Team, Jersey City, New Jerseay, United States - Full time</p>
        </div>
    </section>
    <section class="JDtabs">
        <ul>
            <li class="active" id="overviewBTN" onclick="overview()">OVERVIEW</li>
            <li id="applicationBTN" onclick="application()">APPLICATION</li>
        </ul>
    </section>

    <section class="JobDetails">
        <div class="container">
            <div id="overview">
            
                <div class="descriptionHeading">
                    <h6>Description</h6>
                    <a href="#"> <i class="fab fa-share-alt"></i> Share this job</a>
                </div>

                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Commodi voluptate quam non esse? Natus
                    vitae deserunt doloribus aliquam eveniet corporis, ducimus eum dignissimos minus rerum. Distinctio
                    vero sapiente fugit accusantium.
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum pariatur quasi, excepturi nobis, dolor placeat, est quibusdam blanditiis minima maxime dolorem maiores quidem dignissimos aliquam natus inventore fugiat doloremque suscipit?
                </p>

                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Commodi voluptate quam non esse? Natus
                    vitae deserunt doloribus aliquam eveniet corporis, ducimus eum dignissimos minus rerum. Distinctio
                    vero sapiente fugit accusantium.
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum pariatur quasi, excepturi nobis, dolor placeat, est quibusdam blanditiis minima maxime dolorem maiores quidem dignissimos aliquam natus inventore fugiat doloremque suscipit?
                </p>

                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Commodi voluptate quam non esse? Natus
                    vitae deserunt doloribus aliquam eveniet corporis, ducimus eum dignissimos minus rerum. Distinctio
                    vero sapiente fugit accusantium.
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum pariatur quasi, excepturi nobis, dolor placeat, est quibusdam blanditiis minima maxime dolorem maiores quidem dignissimos aliquam natus inventore fugiat doloremque suscipit?
                </p>
                <div class="descriptionHeading">
                    <h6>Requirements</h6>
                </div>
    
                <ul>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>
                    <li>Lorem ipsum dolor sit amet, consectetur elit.</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>
                    <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis porro repellat quam consequuntur quis non officia!</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit sit amet.</li>
                </ul>
            </div>


            <div id="application" class="d-none">
                <p class="required">Required</p>
                <form action="#">
                    <div class="personalDetails">
                        <h5>Personal Information</h5>
                        <button type="reset" class="clear">Clear</button>
                    </div>

                    <div class="nameSec">
                        <div class="name">
                            <label for="fname" class="required">First Name</label>
                            <input type="text" name="fname" required>
                        </div>
                        <div class="name">
                            <label for="lname" class="required">Last Name</label>
                            <input type="text" name="lname" required>
                        </div>
                    </div>
                    <label for="email" class="required">Email</label>
                    <input type="email" name="email" required>

                    <label for="pnum" class="required">Phone Number</label>
                    <input type="number" name="pnum" required>

                    <label for="resume" class="required">Upload Your Resume</label>
                    <input type="file" required>

                    <label for="coverLetter">Upload Cover Letter</label>
                    <input type="file" >

                    <div class="applicationSubmit">
                        <button type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@section('script')
	<script type="text/javascript">
        function application() {
            var applicationSection = document.getElementById('application');
            var overviewSection = document.getElementById('overview');
            var applicationBTN = document.getElementById('applicationBTN')
            var overviewBTN = document.getElementById('overviewBTN')
            applicationSection.classList.remove('d-none')
            overviewSection.classList.add('d-none')
            applicationBTN.classList.add('active')
            overviewBTN.classList.remove('active')
        }
        
        function overview() {
            var applicationSection = document.getElementById('application');
            var overviewSection = document.getElementById('overview');
            var applicationBTN = document.getElementById('applicationBTN')
            var overviewBTN = document.getElementById('overviewBTN')
            applicationSection.classList.add('d-none')
            overviewSection.classList.remove('d-none')
            applicationBTN.classList.remove('active')
            overviewBTN.classList.add('active')
        }
    </script>
@stop
@endsection