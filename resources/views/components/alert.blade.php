<div class="px-4 pt-4">
    @if ($message = session()->has('succes'))
        <div class="alert alert-success alert-dismissible fade show success" role="alert">
            <p class="text-white mb-0 alert-icon "> <i class="ni ni-check-bold"></i>&nbsp;{{ session()->get('succes') }}</p>
        </div>
    @endif
    @if ($message = session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show error" role="alert">
            <p class="text-white mb-0 alert-icon"> <i class="ni ni-fat-remove"></i>&nbsp;{{ session()->get('error') }}</p>
        </div>
    @endif
</div>
