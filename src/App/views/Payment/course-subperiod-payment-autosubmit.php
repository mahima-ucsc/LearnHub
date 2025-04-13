<?php include $this->resolve("partials/_header.php"); ?>
<script src="/assets/js/payment/form-auto-submit.js"></script>

<form method="POST" action="https://sandbox.payhere.lk/pay/checkout">">
    <!-- Hidden inputs -->
    <input type="hidden" name="first_name" value="<?= $first_name ?>">
    <input type="hidden" name="last_name" value="<?= $last_name ?>">
    <input type="hidden" name="email" value="<?= $email ?>">
    <input type="hidden" name="phone" value="<?= $phone ?>">
    <input type="hidden" name="address" value="<?= $address ?>">
    <input type="hidden" name="city" value="<?= $city ?>">
    <input type="hidden" name="merchant_id" value="<?= $merchant_id ?>">
    <input type="hidden" name="return_url" value="<?= $return_url ?>">
    <input type="hidden" name="cancel_url" value="<?= $cancel_url ?>">
    <input type="hidden" name="notify_url" value="<?= $notify_url ?>">
    <input type="hidden" name="country" value="<?= $country ?>">
    <input type="hidden" name="items" value="<?= $items ?>">
    <input type="hidden" name="order_id" value="<?= $order_id ?>">
    <input type="hidden" name="currency" value="<?= $currency ?>">
    <input type="hidden" name="amount" value="<?= $amount ?>">
    <input type="hidden" name="hash" value="<?= $hash ?>">
</form>

<?php include $this->resolve("partials/_footer.php"); ?>