</main>
    <footer>
        <p>&copy;PHP Moters, All rights reserved</p>
        <p>All images used are believed to be in "Fair Use". Please notify the author if any are not and they will be removed.</p>
        <?php
            $file = $_SERVER["SCRIPT_NAME"];
            $break = Explode('/', $file);
            $pfile = $break[count($break) - 1];
            echo "Last Updated: " .date("d F \, Y");
        ?>
    </footer>
    </body>
</html>
