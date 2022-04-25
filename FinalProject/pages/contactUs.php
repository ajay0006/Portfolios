<?php
include "../common/header.php";

include_once '../Controllers/contactUsController.php';

extract($_POST);
$type = 0;
$provinceValues = array("ON", "QC", "NS", 'NB', "MB", "BC", "PE", "SK", "AB", "NL");
sort($provinceValues);

if (isset($typeOfInquiry)) {
    $type = $typeOfInquiry;
    $firstNameUX = $firstName;
    $lastNameUX = $lastName;
    $phoneUX = $contactNum;
    $emailUX = $email;
    $ageUX = $age;
    $provinceUX = $province;
    $cityUX = $city;
    $postalCodeUX = $postalCode;
}

if (isset($_POST["btnSubmit"])) {
    $validatedData = validateFormEntries($_POST);

    if ($validatedData != "") {
        try {
            $myPdo = getPdo();
            switch ($_POST["typeOfInquiry"]) {
                case "1":
                    $validatedData['typeOfInquiry'] = "Yes";
                    updateContactTenant(
                        $myPdo,
                        $validatedData['firstName'],
                        $validatedData['lastName'],
                        $validatedData['email'],
                        $validatedData['age'],
                        $validatedData['contactNum'],
                        $validatedData['city'],
                        $validatedData['postalCode'],
                        $validatedData['province'],
                        $validatedData['typeOfInquiry'],
                        $validatedData['rentAmount'],
                        $validatedData['comments']
                    );
                    break;

                case "2":
                    $validatedData['typeOfInquiry'] = "Yes";
                    updateContactInvestor(
                        $myPdo,
                        $validatedData['firstName'],
                        $validatedData['lastName'],
                        $validatedData['email'],
                        $validatedData['age'],
                        $validatedData['contactNum'],
                        $validatedData['city'],
                        $validatedData['postalCode'],
                        $validatedData['province'],
                        $validatedData['typeOfInquiry'],
                        $validatedData['investAmount'],
                        $validatedData['comments']
                    );
                    break;

                case "3":
                    $validatedData['typeOfInquiry'] = "Yes";
                    updateContactShortStay(
                        $myPdo,
                        $validatedData['firstName'],
                        $validatedData['lastName'],
                        $validatedData['email'],
                        $validatedData['age'],
                        $validatedData['contactNum'],
                        $validatedData['city'],
                        $validatedData['postalCode'],
                        $validatedData['province'],
                        $validatedData['typeOfInquiry'],
                        $validatedData['comments']
                    );
                    break;
            }
        } catch (PDOException $e) {
            //echo "<br>" . $e->getMessage();
        } finally {
            $myPdo = null;
            $type = $firstNameUX = $lastNameUX = $phoneUX = $emailUX = $ageUX = $provinceUX = $cityUX = $postalCodeUX = "";
            $confirmation = "Thank You for contacting us!";
        }
    }
}
?>
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
  <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
  </symbol>
  <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
</svg>
<div class="section ">
    <div class="section-content container">
        <div class="text-center ">
            <h1 class="mt-4 mb-4">Contact Us</h1>
        </div>
        <div class="row ">
            <div class="col-md-6  offset-md-3 shadow mb-5">
                <?php if(isset($confirmation)){?>
            <div class="alert alert-success d-flex align-items-center" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
  <div>
                    <?php echo $confirmation ?>
                </div></div> <?php } ?>
                <form action="ContactUs.php" method="post" id="contactUsForm" class="row mt-5">
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="first_name" class="form-label">First name</label>
                            <input type="text" class="form-control" id="first_name" required name="firstName" <?php if (isset($firstNameUX)) {
                                                                                                                    echo 'value =' . $firstNameUX;
                                                                                                                } ?>>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="last_name" class="form-label">Last name</label>
                            <input type="text" class="form-control" id="last_name" required name="lastName" <?php if (isset($lastNameUX)) {
                                                                                                                echo 'value =' . $lastNameUX;
                                                                                                            } ?>>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="contactNum" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="contactNum" required name="contactNum" <?php if (isset($phoneUX)) {
                                                                                                                    echo 'value =' . $phoneUX;
                                                                                                                } ?>>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for=age class="form-label">Age</label>
                            <input type="text" class="form-control" id="age" required name="age" <?php if (isset($ageUX)) {
                                                                                            echo 'value =' . $ageUX;
                                                                                        } ?>>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for=email class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" required name="email" <?php if (isset($emailUX)) {
                                                                                                        echo 'value =' . $emailUX;
                                                                                                    } ?>>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="province" class="form-label">Province</label>
                            <select class="form-select" id="province" required name="province">
                                <option value=0>Select ...</option>
                                <?php foreach ($provinceValues as $value) {
                                    echo "<option  value='$value'>" . $value . "</option>";

                                    if (isset($provinceUX) && $provinceUX == $value) {
                                        echo "selected='selected'";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" required name="city" <?php if (isset($cityUX)) {
                                                                                                        echo 'value =' . $cityUX;
                                                                                                    } ?>>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for=zip-code class="form-label">Your zip code</label>
                            <input type="text" class="form-control" id="zip-code" required name="postalCode" <?php if (isset($postalCodeUX)) {
                                                                                                                    echo 'value =' . $postalCodeUX;
                                                                                                                } ?>>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6">
                        <div class="">
                            <label for="inquiryType" class="form-label">Type of Inquiry</label>
                            <select class="form-select" id="inquiryType" name="typeOfInquiry">
                                <option value=0>Select ...</option>
                                <option value=1 <?php if ($type == 1) {
                                                    echo "selected='selected'";
                                                } ?>>Prospective Tenant
                                </option>
                                <option value=2 <?php if ($type == 2) {
                                                    echo "selected='selected'";
                                                } ?>>Prospective Investor
                                </option>
                                <option value=3 <?php if ($type == 3) {
                                                    echo "selected='selected'";
                                                } ?>>Short Stay
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6" id="addField1" style="display: none;">
                        <div class="form-group">
                            <label for="rentAmount" class="form-label">How much would you like to pay?</label>
                            <input type="text" class="form-control" id="rentAmount" required name="rentAmount">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6" id="addField2" style="display: none;">
                        <div class="form-group">
                            <label for="investAmount" class="form-label"> How much would you be willing to
                                invest?</label>
                            <input type="text" class="form-control" id="investAmount" required name="investAmount">
                        </div>
                    </div>

                    <div class=col-12>
                        <div class="form-group">
                            <label for="message" class="form-label">Message</label>
                            <textarea id="message" class="form-control" required rows=3 name="comments"></textarea>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-between align-items-center flex-column flex-md-row mt-2 mb-5">
                        <div class="">
                            <input type="checkbox" class="" id="termsPolicy" required name="termsPolicy">
                            <label class="form-check-label" for="termsPolicy">I've read and agree with the <a href="/Aisha/pages/Terms.php" target="_blank">Terms</a> & <a href="/Aisha/pages/privacy.php" target="_blank">Policy</a></label>
                        </div>
                        <div class="form-group mb-0 mt-2">
                            <button type="submit" name="btnSubmit" class="btn btn-primary ">Send message
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include "../common/footer.php";
?>