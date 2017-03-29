</main>
<footer id="footer">
    Copyrigth <?php echo date("Y", time()); ?> Eduard Symonian
</footer>
</body>
</html>
<?php if(isset($database)) { $database->close_connection();}?>