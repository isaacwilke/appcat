<footer class="footer pt-3  ">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-12 mb-lg-0 mb-4">
                <div class="copyright text-center text-sm text-muted text-lg-start">
                    {{-- ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script>,
                    made with <i class="fa fa-heart"></i> by
                    <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                    &
                    <a href="https://www.updivision.com" class="font-weight-bold" target="_blank">UPDIVISION</a>
                    for a better web. --}}
                    @if(Session::has('one'))
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>,
                        made with <i class="fa fa-heart"></i> by
                        <a href="" class="font-weight-bold" target="_blank">{{Session::get('one')}}</a>
                     
                    @elseif(Session::has('two'))
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>,
                        made with <i class="fa fa-heart"></i> by
                        <a href="" class="font-weight-bold" target="_blank">{{Session::get('two')}}</a>
                      
                    @endif
                </div>
            </div>
           
        </div>
    </div>
</footer>
