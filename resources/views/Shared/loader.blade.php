<style>
    /* Loader Styles */
    /* Semi-dark background for the page when the loader is visible */

    .loader-wrapper {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        /* Semi-dark background */
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        /* Ensures it's above all content */
    }

    .loader {
        width: 50px;
        aspect-ratio: 1.154;
        position: relative;
        background: conic-gradient(from 120deg at 50% 64%, #0000, #e67e22 1deg 120deg, #0000 121deg);
        animation: l27-0 1.5s infinite cubic-bezier(0.3, 1, 0, 1);
    }

    /* Loader's inner animations */
    .loader:before,
    .loader:after {
        content: '';
        position: absolute;
        inset: 0;
        background: inherit;
        transform-origin: 50% 66%;
        animation: l27-1 1.5s infinite;
    }

    .loader:after {
        --s: -1;
    }

    /* Keyframes for the loader animation */
    @keyframes l27-0 {

        0%,
        30% {
            transform: rotate(0);
        }

        70% {
            transform: rotate(120deg);
        }

        70.01%,
        100% {
            transform: rotate(360deg);
        }
    }

    @keyframes l27-1 {
        0% {
            transform: rotate(calc(var(--s, 1)*120deg)) translate(0);
        }

        30%,
        70% {
            transform: rotate(calc(var(--s, 1)*120deg)) translate(calc(var(--s, 1)*-5px), 10px);
        }

        100% {
            transform: rotate(calc(var(--s, 1)*120deg)) translate(0);
        }
    }

    /* End Loader Styles */
</style>

<div class="loader-wrapper" id="loaderWrapper">
    <div class="loader"></div>
</div>
