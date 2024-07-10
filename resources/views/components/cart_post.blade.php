<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Ganti SET_YOUR_CLIENT_KEY_HERE dengan client key kamu -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
    <!-- Catatan: Ganti dengan src="https://app.midtrans.com/snap/snap.js" untuk environment Production -->
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #F3D7CA;
        }

        #snap-container-wrapper {
            position: relative;
            width: 400px;
            height: 600px;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        #snap-container {
            width: 100%;
            height: 100%;
        }

        #close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: transparent;
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            font-size: 20px;
            cursor: pointer;
            z-index: 1000;
            text-align: center;
            line-height: 28px;
        }
    </style>
</head>

<body>
    <!-- Wrapper untuk Snap embed dan tombol Close -->
    <div id="snap-container-wrapper">
        <div id="snap-container"></div>
        <!-- Tombol Close -->
        <button id="close-button">×</button>
    </div>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            // Memanggil Snap modal secara otomatis saat halaman dimuat
            window.snap.embed('{{ $snapToken }}', {
                embedId: 'snap-container',
                onSuccess: function(result) {
                    /* Implementasi jika pembayaran sukses */
                    alert("payment success!");
                    console.log(result);
                },
                onPending: function(result) {
                    /* Implementasi jika pembayaran pending */
                    alert("waiting for your payment!");
                    console.log(result);
                },
                onError: function(result) {
                    /* Implementasi jika pembayaran gagal */
                    alert("payment failed!");
                    console.log(result);
                },
                onClose: function() {
                    /* Implementasi jika pengguna menutup popup tanpa menyelesaikan pembayaran */
                    alert('You closed the popup without finishing the payment');
                }
            });
        });

        // Event listener untuk tombol Close
        var closeButton = document.getElementById('close-button');
        closeButton.addEventListener('click', function() {
            // Implementasi untuk kembali ke view cart
            window.location.href = '/carts';

            // Panggil metode rollbackTransaction
            rollbackTransaction();
        });

        // Fungsi rollbackTransaction
        function rollbackTransaction() {
            // Panggil metode rollbackTransaction di backend melalui AJAX atau sesuai implementasi yang kamu punya
            fetch('/rollback-transaction', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    // Masukkan parameter yang dibutuhkan untuk rollback
                })
            }).then(response => response.json()).then(data => {
                console.log('Transaction rolled back:', data);
            }).catch(error => {
                console.error('Error rolling back transaction:', error);
            });
        }
    </script>
</body>

</html>
