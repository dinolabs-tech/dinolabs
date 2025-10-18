<?php
session_start();

include("db_connect.php");
?>

<!DOCTYPE html>
<html lang="en">

<?php include('components/head.php');?>
<style>
        body { font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 0; color: #333; }
        header { background: #004080; color: #fff; padding: 20px 0; text-align: center; }
        main { padding: 20px; max-width: 900px; margin: auto; }
        h1, h2, h3 { color: #004080; }
        section { margin-bottom: 20px; }
        footer { background: #f4f4f4; text-align: center; padding: 10px; font-size: 0.9em; }
        .container { width: 90%; margin: auto; }
    </style>

<body>

  <!-- Topbar Start -->
    <?php include('components/topbar.php'); ?>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid position-relative p-0">
        <?php include('components/navbar.php'); ?>

        <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
            <div class="row py-5">
                <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-4 text-white animated zoomIn">Refund Policy</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <main>
    <h1>Dinolabs Tech Services Refund Policy</h1>
    <p>Dinolabs Tech Services will process all refund requests in line with this Refund Policy.</p>
    <p>Note that Dinolabs Tech Services may vary this Refund Policy at any time. If we vary this Refund Policy, we will provide notice by publishing the varied Refund Policy on our Website. You accept that by doing this, Dinolabs Tech Services has provided you with sufficient notice of the variation to its Refund Policy. Your continued use of our Website Software services will be deemed as acceptance of the varied terms by you.</p>
    <p>To request a refund, you must submit a service cancellation request through by sending an email to enquiries@dinolabs.org within the time stipulated in this Refund Policy for the relevant service you wish to cancel.</p>

    <h2>General Refund Process</h2>
    <ol>
        <li>Service(s) must be cancelled before a refund can be issued</li>
        <li>You will not be entitled to a refund if your domain name has been flagged as suspicious, is considered to be registered for improper use, or is registered in breach of our Terms of Service.</li>
        <li>You will not be entitled to a refund if your service is suspended or terminated as a result of a breach of our Terms of Service.</li>
        <li>You will not be entitled to a refund if your license has been generated or downloaded after purchase.</li>
        <li>All eligible refunds will be automatically credited to your client account with Dinolabs Tech Services, unless you specifically request for a cash refund. Money refunded into your client account can be used at a later date to pay for other products and services. You can view your credit balance by logging into your client account and going to the section on your client area dashboard.</li>
        <li>If you have requested a cash refund, Dinolabs Tech Services will only give such a refund where the account details you have provided for the refund are an exact match with that from which we received your payment. In event of any discrepancy in the account details, an eligible refund will only be made into your client account.</li>
        <li>Requests for cash refunds will be processed and completed within a minimum of 5 days and a maximum of 15 days from the date of request. All cash refund requests are subject to an administrative fee which will be deducted from the amount to be refunded to you. In the event that the amount to be refunded is less than the administrative fee i.e bank charges, you will only be entitled to a refund into your client account.</li>
        <li>On no account will the same product or service be entitled to a refund more than once.</li>
        <li>No portion of your Wallet Balance may be transferred to another Dinolabs Tech Services account.</li>
        <li>This Refund Policy for Dinolabs Tech Services Wallet may be amended from time to time.</li>
    </ol>

    <h2>Overpayment</h2>
    <p>If we become aware that you have overpaid for any product or service, we will automatically credit the amount of that overpayment to your Dinolabs Tech Services account where you can use it to pay for other products or services at a later date. You will be able to see this on your client area dashboard.</p>
    <p>If you wish for an overpayment to be refunded to your bank account, you must send a request for a refund to enquiries@dinolabs.org The request must give required details including the license code generated for which the overpayment was made, date of payment, method of payment (including, where applicable, bank details from which payment was made) and amount of overpayment.</p>
    <p>Once we have received your request, it will be dealt with in accordance with this Refund Policy.</p>

    <p>This Refund Policy was last modified on [21st March 2025]</p>

    </main>

        <!-- Footer Start -->
    <?php include('components/footer.php'); ?>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>

    <?php include('components/scripts.php'); ?>
</body>
</html>
