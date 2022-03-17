    <footer class="main-footer">
    
        <div class="float-right d-none d-sm-inline">
        Anything you want
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2022.</strong>
    </footer>
</div>
<script>
    $('#menuName').text(sessionStorage.name);
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        'Authorization': 'Bearer '+sessionStorage.token,
        }
    });
    function logout() {
        $.ajax({
        url:'http://127.0.0.1:8000/api/logout/',
        type:'POST',
        data: {'id':sessionStorage.id},
        cache:false,
        contentType:false,
        processData:false,
        success:function(e){
            sessionStorage.clear();
            window.location="{{ url('') }}";
        },
        error:function(error){
            console.log(error);
        }
    });
}

    function cekPin() {
        $.ajax({
        url:'http://127.0.0.1:8000/api/pin/cek/'+sessionStorage.id,
        type:'get',
        success:function(e){
            window.location="{{ url('/pin') }}";
        },
        error:function(error){
            window.location="{{ url('/newpin') }}";
        }
    });
}
</script>
</body>
</html>