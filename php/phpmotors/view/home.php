<?php
    $title="Home";
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php';?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/nav.php';?>

<h1 class="title">Welcome to PHP Motors!</h1>

<div class="model">
    <h2>DMC Delorean</h2>
    <p>3 cup holders <br> 
    Superman Doors <br>    
    Fuzzy dice!</p>
    <img class="car" src="images/vehicles/delorean.jpg" alt="delorean car" title="delorean">
    <button>Own Today</button>

</div>

<div class="lower">
    <div class="reviews">
        <h2>DMC Delorean Reviews</h2>
        <ul>
        <li>"So fast its almost like traveling in time" (4/5)</li>
        <li>"Coolest ride on the road" (4/5)</li>
        <li>"I'm feeling Marty McFly!" (5/5)</li>
        <li>"The most futuristic ride of our day." (4.5/5)</li>
        <li>"80's livin and I love it!" (5/5)</li>
        </ul>
    </div>

    <div class="upgrades">
        <h2>Delorean Upgrades</h2>
        <div class="images">
            <div class="row1">
                <figure>
                    <img src="images/upgrades/flux-cap.png" class="flux" title="flux Capasitor" alt="Flux Capacitor">
                    <figcaption>Flux Capacitor</figcaption>
                </figure>
                <figure>
                    <img src="images/upgrades/bumper_sticker.jpg" class="sticker" title="bumber sticker" alt="Bumper Stickers">
                    <figcaption>Bumper Stickers</figcaption>
                </figure>
            </div>
            <div class="row2">
                <figure>
                    <img src="images/upgrades/flame.jpg" class="flame" title="flame image" alt="Flame Decals">
                    <figcaption>Flame Decals</figcaption>
                </figure>
                <figure>
                    <img src="images/upgrades/hub-cap.jpg" class="cap" title="hub-Cap" alt="Hub cap">
                    <figcaption>Hub Caps</figcaption>
                </figure>
            </div>
        </div>
    </div>
</div>



<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>





