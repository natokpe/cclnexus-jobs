<?php
/**
 * Template Name: Apply
 */

declare(strict_types = 1);

use NatOkpe\Wp\Theme\Nexusdream\Theme;
use NatOkpe\Wp\Theme\Nexusdream\Utils\Request;





?>
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Email address</label>
  <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
</div>

<select class="form-select" aria-label="Default select example">
    <option selected>Highest Educational Qualification?</option>
    <option value="1">One</option>
    <option value="2">Two</option>
    <option value="3">Three</option>
</select>

<div class="mb-3">
    <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
</div>


<div class="mb-3">
    <label for="apply-cv" class="form-label">Upload your CV</label>
    <input class="form-control" type="file" id="apply-cv" aria-describedby="apply-cv-help">
    <div id="apply-cv-help" class="form-text">Acceptable format is PDF and file size must not be greater than 25MB.</div>
</div>

<div class="mb-3">
    <label for="apply-cover-letter" class="form-label">Upload your CV</label>
    <input class="form-control" type="file" id="apply-cover-letter" aria-describedby="apply-cover-letter-help">
    <div id="apply-cover-letter-help" class="form-text">Acceptable format is PDF and file size must not be greater than 25MB.</div>
</div>

<select class="form-select" aria-label="Default select example">
    <option selected>How did you hear about us?</option>
    <option value="1">One</option>
    <option value="2">Two</option>
    <option value="3">Three</option>
</select>

<div class="form-check">
    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
    <label class="form-check-label" for="flexCheckDefault">I agree to the Terms and Conditions and Privacy Policy.</label>
</div>

<?php
