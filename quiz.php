<?php include('common/header.php') ?>
    <div class="container">
        <form action="/quiz/markquiz.php" method="post">
            <fieldset>
                <legend>Questions</legend>
                <div class="row">
                    <div class="col-25">
                        <label for="fname">First Name</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="fname" name="firstname" pattern="[A-Za-z0-9 _]+$" maxlength="20"
                               required="required" placeholder="Your First name..">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="lname">Last Name</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="lname" name="lastname" pattern="[A-Za-z0-9 _]+$" maxlength="20"
                               required="required" placeholder="Your last name..">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="sid">Student ID</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="sid" name="studentid" required="required" pattern="[0-9]{7}||[0-9]{10}"
                               placeholder="Your Student ID.." title="7 0r 10 digits">

                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="textques">What is your previous knowledge about my hometown?</label>
                    </div>
                    <div class="col-75">
                        <textarea id="textques" name="textquestion" required="required" placeholder="Write answer.."
                                  style="height:200px"></textarea>
                    </div>
                </div>


                <div class="row">
                    <div class="col-25">
                        <label>Which is my Hometown?</label>
                    </div>
                    <div class="col-75">
                        <label class="container">Melbourne
                            <input type="radio" checked="checked" name="home_town" value="1">
                            <span class="checkmark"></span>
                        </label>
                        <label class="container">Ernakulam
                            <input type="radio" name="home_town" value="2">
                            <span class="checkmark"></span>
                        </label>
                        <label class="container">Sydney
                            <input type="radio" name="home_town" value="3">
                            <span class="checkmark"></span>
                        </label>
                        <label class="container">Mumbai
                            <input type="radio" name="home_town" value="4">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>


                <div class="row">
                    <div class="col-25">
                        <label>Major three religions in my hometown?</label>
                    </div>
                    <div class="col-75">
                        <label class="container">Hindu
                            <input type="checkbox" checked="checked" name="religion[]" value="1">
                            <span class="checkmark"></span>
                        </label>
                        <label class="container">Christian
                            <input type="checkbox" name="religion[]" value="2">
                            <span class="checkmark"></span>
                        </label>
                        <label class="container">Muslim
                            <input type="checkbox" name="religion[]" value="3">
                            <span class="checkmark"></span>
                        </label>
                        <label class="container">Sikh
                            <input type="checkbox" name="religion[]" value="4">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>


                <div class="row">
                    <div class="col-25">
                        <label>Which is my home country?</label>
                    </div>
                    <div class="col-75">
                        <select name="home_country">
                            <option value="">Select Option</option>
                            <option value="1">Australia</option>
                            <option value="2">China</option>
                            <option value="3">India</option>
                            <option value="4">Pakistan</option>
                            <option value="5">Japan</option>
                        </select>
                    </div>
                </div>

                <br>
                <div class="row">
                    <div class="col-25">
                        <label>Last census in Ernakulam taken place, in?</label>
                    </div>
                    <div class="col-75">

                        <input type="number" name="quantity" min="2000" max="2020">
                    </div>
                </div>


                <div class="row">
                    <input id="anim2" type="submit" name="submit" formmethod="post" value="Submit">
                </div>
            </fieldset>
        </form>
    </div>

<?php include('common/footer.php') ?>