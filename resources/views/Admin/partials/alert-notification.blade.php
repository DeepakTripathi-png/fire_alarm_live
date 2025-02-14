{{-- <style>


.alert-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: none;
    align-items: center; 
    justify-content: center; 
    z-index: 9999;
}


.alert-box {
    border: 1px solid #dee2e6;
    border-radius: 5px;
    background-color: white;
    padding: 20px;
    width: 400px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    z-index: 10000;
    margin-top: 300px;
    margin-left: 767px;
}


.alert-header {
    background-color: red;
    color: white;
    text-align: center;
    padding: 10px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
}

.alert-title {
    font-size: 24px;
    margin: 0;
}


.alert-content {
    padding: 20px;
}

.alert-content p {
    margin: 0;
    font-size: 16px;
}

.alert-content span {
    color: #007bff;
}


.alert-footer {
    text-align: center;
    margin-top: 20px;
}

.alert-footer button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 16px;
}



/* .alert-box {
    border: 1px solid #dee2e6;
    border-radius: 5px;
    background-color: white;
    padding: 20px;
    width: 400px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    z-index: 10000;
    margin-top: 300px;
    margin-left: 767px;
} */


</style>    



<!-- Popup modal backdrop -->
<div id="alertBackdrop" class="alert-backdrop">
    <div class="alert-box">
        <div class="alert-header">
            <p class="alert-title">Alert</p>
        </div>
        <div class="alert-content">
            <p>Device ID: <span id="deviceId"></span></p>
            <p>Device Type: <span id="deviceType"></span></p>
            <p>Location: <span id="location"></span></p>
            <p>Description: <span id="alertMessage"></span></p>
        </div>
        <div class="alert-footer">
            <button type="button" class="btn-ok">OK</button>
        </div>
    </div>
</div>

{{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}

{{-- <script>
    function showAlert(notification) {
        // Show the backdrop and alert box
        $('#alertBackdrop').fadeIn();

        // Populate the alert box with dynamic content
        $('#deviceId').text(notification.device_id);
        $('#deviceType').text(notification.device_type);
        $('#location').text(notification.location);
        $('#alertMessage').text(notification.alert_message);

        // Close alert when clicking OK
        $('.btn-ok').on('click', function() {
            $('#alertBackdrop').fadeOut();
        });
    }

    function pollNotifications() {
        setInterval(() => {
            $.ajax({
                url: "{{ route('showAlert') }}", 
                method: 'GET',
                success: function(response) {
                    if (response.alert_notification.length > 0) {
                        response.alert_notification.forEach(notification => {
                            showAlert(notification);
                        });
                    }
                },
                error: function(error) {
                    console.error('Error fetching notifications:', error);
                }
            });
        }, 100); // Check for new notifications every minute
    }

    $(document).ready(function() {
        pollNotifications();
    });
</script> --}}

<style>
    /* Modal Css */  
    body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .alert_modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 250px;
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .alert_modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 0;
            border: 1px solid #888;
            width: 400px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        /* The Close Button */
        .alert_close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            margin-right: 10px;
            margin-top: -74px;
            cursor: pointer;
        }

        .alert_close:hover,
        .alert_close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .alert-header {
            color: red;
            background-color: white;
            padding: 10px;
            font-size: 30px;
            font-weight: bold;
            text-align: center;
            border-bottom: 1px solid #888;
        }
        .alert-top-bar {
            background-color: red;
            height: 10px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .alert-content {
            text-align: left;
            padding: 20px;
        }
        .alert-content p {
            margin: 10px 0;
        }
        .alert-content span {
            color: #007bff;
        }
        .alert-footer {
            text-align: center;
            padding: 14px;
        }
        .alert-footer button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 7px 15px;
            border-radius: 10px;
           
            cursor: pointer;
            font-size: 16px;
        }
        .alert-footer button:hover {
            background-color: #0056b3;
        }
        .show-alert-button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 20px;
        }
        .show-alert-button:hover {
            background-color: #0056b3;
        }
</style>

<div id="mySizeChartModal" class="alert_modal">
    <div class="alert_modal-content">
        <div class="alert-top-bar"></div>
        <div class="alert-header">
            Alert
        </div>
        <span class="alert_close" onclick="closeAlert()">&times;</span>
        <div class="alert-content">
            <p>Device ID : <span>TOR2314233</span></p>
            <p>Device Type : Smoke Detector</p>
            <p>Location : Phursungi Pune</p>
            <p>Description : Signals the presence of smoke in a specific area.</p>
        </div>
        <div class="alert-footer">
            <button onclick="closeAlert()">OK</button>
        </div>
    </div>
</div>



{{-- Added ashviniB --}}
<script>
    function showAlert() {
        document.getElementById('mySizeChartModal').style.display = 'block';
    }
    function closeAlert() {
        document.getElementById('mySizeChartModal').style.display = 'none';
    }

    window.onclick = function(event) {
        var modal = document.getElementById('mySizeChartModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
</script>
{{-- End --}}

