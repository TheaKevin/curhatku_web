<div>
    Please verify your email address.
</div>

<div>
    Please click button below to resend verification email.
</div>

<form id="form" action="{{ route('verification.send') }}" method="POST"  enctype="multipart/form-data" style="width: 1008px; margin-top: 32px;">
    @csrf

    <button class="submitButton" type="submit">Resend</button>

</form>