    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">

<footer>
        <ul class="icons">
            <?php foreach($socials as $social) : ?>
                <li>
                    <a href="<?= $social->getLink() ?>" target="blank">
                        <ion-icon name="<?= $social->getIcon() ?>"></ion-icon>
                    </a>
                </li>
            <?php endforeach ?>
        </ul>
        <ul class="menu">
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Admin</a></li>
        </ul>
            <div class="footer-copyright">
                <p>Copyright @ 2022 All Rights Reserved.</p>
            </div>
    </footer>