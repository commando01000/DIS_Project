<div id="our-team" class="gh adjusted-scrolling w-75 mx-auto">
    <h2 class="fa fa-users">TEAM</h2>
    <h1>OUR HARDWORK TEAM</h1>
    <div class="cards justify-content-center d-flex flex-wrap gap-5 mt-5">
        <div class="card">
            <img src="{{ asset('assets/images/hero.jpg') }}" alt="Ahmed CEO">
            <h3>Ahmed Abdelhay</h3>
            <div class="qr-code" data-url="https://example.com/ahmed-ceo"></div>
        </div>

        <div class="card">
            <img src="{{ asset('assets/images/5.png') }}" alt="Ahmed operation">
            <h3>Ahmed Operation</h3>
            <div class="qr-code" data-url="https://example.com/ahmed-ceo"></div>
        </div>
    </div>
    <div class="gradient-line"></div>
</div>



<script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const cards = document.querySelectorAll(".card");

        cards.forEach((card) => {
            const qrContainer = card.querySelector(".qr-code");
            const url = qrContainer.getAttribute("data-url");

            if (url) {
                new QRCode(qrContainer, {
                    text: url,
                    width: 100,
                    height: 100,
                    colorDark: "#333333",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H,
                });
            }
        });
    });
</script>
