<footer>
    <p>Footer</p>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery.js"></script>

<?php if ($js) : ?>
    <?php foreach ($js as $script): ?>
        <script src="js/<?=$script?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
</body>
</html>