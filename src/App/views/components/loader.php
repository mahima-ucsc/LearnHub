<style>
    /* Loader */
    #loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.8);
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 20px;
        font-weight: bold;
        color: #333;
        display: none;
        /* Initially hidden */
        z-index: 9999;
    }

    /* From Uiverse.io */
    .loader-anime {
        width: 48px;
        height: 48px;
        margin: auto;
        position: relative;
    }

    .loader-anime:before {
        content: '';
        width: 48px;
        height: 5px;
        background: #FFD700;
        position: absolute;
        top: 60px;
        left: 0;
        border-radius: 50%;
        animation: shadow324 0.5s linear infinite;
    }

    .loader-anime:after {
        content: '';
        width: 100%;
        height: 100%;
        background: #FFD700;
        position: absolute;
        top: 0;
        left: 0;
        border-radius: 50%;
        animation: jump7456 0.5s linear infinite;
    }

    @keyframes jump7456 {
        15% {
            border-bottom-right-radius: 50%;
        }

        25% {
            transform: translateY(9px) rotate(22.5deg);
        }

        50% {
            transform: translateY(18px) scale(1, .9) rotate(45deg);
            border-bottom-right-radius: 40px;
        }

        75% {
            transform: translateY(9px) rotate(67.5deg);
        }

        100% {
            transform: translateY(0) rotate(90deg);
        }
    }

    @keyframes shadow324 {

        0%,
        100% {
            transform: scale(1, 1);
        }

        50% {
            transform: scale(1.2, 1);
        }
    }
</style>

<div id="loader">
    <div class="loader-anime"></div>
</div>
<script>
    function showLoader() {
        document.getElementById("loader").style.display = "flex";
    }
</script>