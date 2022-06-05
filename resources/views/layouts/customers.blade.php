<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- CSRF Token -->
    <!-- Styles -->
    <link rel="icon" href="{{ asset('images/main/favicon.ico') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('css/customers.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <!-- Styles -->


    <style>
        .preloader {
            background-color: rgb(235, 241, 247);
            height: 100vh !important;
            width: 100% !important;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 999999 !important;
            transition: 0.6s 0.6s all ease-in-out;
            margin: 0 auto;
            overflow: hidden;
            display: flex;
            justify-content: center !important;
            align-items: center !important;
        }

        .preloader .loader-holder {
            height: 120px !important;
        }

        .preloader p {
            font-weight: 500 !important;
            color: #3a3636;
        }

        .preloader .loader3 {
            width: 50px;
            height: 50px;
            display: inline-block;
            padding: 0px;
            text-align: left;
            margin-left: 12px;
        }

        .preloader .loader3 span {
            position: absolute;
            display: inline-block;
            width: 80px;
            height: 80px;
            border-radius: 100%;
            background: #ffafaf;
            -webkit-animation: loader3 1.5s linear infinite;
            animation: loader3 1.5s linear infinite;
        }

        .preloader .loader3 span:last-child {
            animation-delay: -0.9s;
            -webkit-animation-delay: -0.9s;
        }

        @keyframes loader3 {
            0% {
                transform: scale(0, 0);
                opacity: 0.8;
            }

            100% {
                transform: scale(1, 1);
                opacity: 0;
            }
        }

        @-webkit-keyframes loader3 {
            0% {
                -webkit-transform: scale(0, 0);
                opacity: 0.8;
            }

            100% {
                -webkit-transform: scale(1, 1);
                opacity: 0;
            }
        }

        @media (max-width: 550px) {
            .preloader .loader3 {
                margin-left: 0px;
            }
        }

    </style>


<style>
    .animate__animated {
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-duration: var(--animate-duration);
  animation-duration: var(--animate-duration);
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
}
.animate__animated.animate__infinite {
  -webkit-animation-iteration-count: infinite;
  animation-iteration-count: infinite;
}
.animate__animated.animate__repeat-1 {
  -webkit-animation-iteration-count: 1;
  animation-iteration-count: 1;
  -webkit-animation-iteration-count: var(--animate-repeat);
  animation-iteration-count: var(--animate-repeat);
}
.animate__animated.animate__repeat-2 {
  -webkit-animation-iteration-count: calc(1 * 2);
  animation-iteration-count: calc(1 * 2);
  -webkit-animation-iteration-count: calc(var(--animate-repeat) * 2);
  animation-iteration-count: calc(var(--animate-repeat) * 2);
}
.animate__animated.animate__repeat-3 {
  -webkit-animation-iteration-count: calc(1 * 3);
  animation-iteration-count: calc(1 * 3);
  -webkit-animation-iteration-count: calc(var(--animate-repeat) * 3);
  animation-iteration-count: calc(var(--animate-repeat) * 3);
}
.animate__animated.animate__delay-1s {
  -webkit-animation-delay: 1s;
  animation-delay: 1s;
  -webkit-animation-delay: var(--animate-delay);
  animation-delay: var(--animate-delay);
}
.animate__animated.animate__delay-2s {
  -webkit-animation-delay: calc(1s * 2);
  animation-delay: calc(1s * 2);
  -webkit-animation-delay: calc(var(--animate-delay) * 2);
  animation-delay: calc(var(--animate-delay) * 2);
}
.animate__animated.animate__delay-3s {
  -webkit-animation-delay: calc(1s * 3);
  animation-delay: calc(1s * 3);
  -webkit-animation-delay: calc(var(--animate-delay) * 3);
  animation-delay: calc(var(--animate-delay) * 3);
}
.animate__animated.animate__delay-4s {
  -webkit-animation-delay: calc(1s * 4);
  animation-delay: calc(1s * 4);
  -webkit-animation-delay: calc(var(--animate-delay) * 4);
  animation-delay: calc(var(--animate-delay) * 4);
}
.animate__animated.animate__delay-5s {
  -webkit-animation-delay: calc(1s * 5);
  animation-delay: calc(1s * 5);
  -webkit-animation-delay: calc(var(--animate-delay) * 5);
  animation-delay: calc(var(--animate-delay) * 5);
}
.animate__animated.animate__faster {
  -webkit-animation-duration: calc(1s / 2);
  animation-duration: calc(1s / 2);
  -webkit-animation-duration: calc(var(--animate-duration) / 2);
  animation-duration: calc(var(--animate-duration) / 2);
}
.animate__animated.animate__fast {
  -webkit-animation-duration: calc(1s * 0.8);
  animation-duration: calc(1s * 0.8);
  -webkit-animation-duration: calc(var(--animate-duration) * 0.8);
  animation-duration: calc(var(--animate-duration) * 0.8);
}
.animate__animated.animate__slow {
  -webkit-animation-duration: calc(1s * 2);
  animation-duration: calc(1s * 2);
  -webkit-animation-duration: calc(var(--animate-duration) * 2);
  animation-duration: calc(var(--animate-duration) * 2);
}
.animate__animated.animate__slower {
  -webkit-animation-duration: calc(1s * 3);
  animation-duration: calc(1s * 3);
  -webkit-animation-duration: calc(var(--animate-duration) * 3);
  animation-duration: calc(var(--animate-duration) * 3);
}
@media print, (prefers-reduced-motion: reduce) {
  .animate__animated {
    -webkit-animation-duration: 1ms !important;
    animation-duration: 1ms !important;
    -webkit-transition-duration: 1ms !important;
    transition-duration: 1ms !important;
    -webkit-animation-iteration-count: 1 !important;
    animation-iteration-count: 1 !important;
  }

  .animate__animated[class*='Out'] {
    opacity: 0;
  }
}
/* Attention seekers  */
@-webkit-keyframes bounce {
  from,
  20%,
  53%,
  to {
    -webkit-animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
    animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }

  40%,
  43% {
    -webkit-animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
    animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
    -webkit-transform: translate3d(0, -30px, 0) scaleY(1.1);
    transform: translate3d(0, -30px, 0) scaleY(1.1);
  }

  70% {
    -webkit-animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
    animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
    -webkit-transform: translate3d(0, -15px, 0) scaleY(1.05);
    transform: translate3d(0, -15px, 0) scaleY(1.05);
  }

  80% {
    -webkit-transition-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
    transition-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
    -webkit-transform: translate3d(0, 0, 0) scaleY(0.95);
    transform: translate3d(0, 0, 0) scaleY(0.95);
  }

  90% {
    -webkit-transform: translate3d(0, -4px, 0) scaleY(1.02);
    transform: translate3d(0, -4px, 0) scaleY(1.02);
  }
}
@keyframes bounce {
  from,
  20%,
  53%,
  to {
    -webkit-animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
    animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }

  40%,
  43% {
    -webkit-animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
    animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
    -webkit-transform: translate3d(0, -30px, 0) scaleY(1.1);
    transform: translate3d(0, -30px, 0) scaleY(1.1);
  }

  70% {
    -webkit-animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
    animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
    -webkit-transform: translate3d(0, -15px, 0) scaleY(1.05);
    transform: translate3d(0, -15px, 0) scaleY(1.05);
  }

  80% {
    -webkit-transition-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
    transition-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
    -webkit-transform: translate3d(0, 0, 0) scaleY(0.95);
    transform: translate3d(0, 0, 0) scaleY(0.95);
  }

  90% {
    -webkit-transform: translate3d(0, -4px, 0) scaleY(1.02);
    transform: translate3d(0, -4px, 0) scaleY(1.02);
  }
}
.animate__bounce {
  -webkit-animation-name: bounce;
  animation-name: bounce;
  -webkit-transform-origin: center bottom;
  transform-origin: center bottom;
}
@-webkit-keyframes flash {
  from,
  50%,
  to {
    opacity: 1;
  }

  25%,
  75% {
    opacity: 0;
  }
}
@keyframes flash {
  from,
  50%,
  to {
    opacity: 1;
  }

  25%,
  75% {
    opacity: 0;
  }
}
.animate__flash {
  -webkit-animation-name: flash;
  animation-name: flash;
}
/* originally authored by Nick Pettit - https://github.com/nickpettit/glide */
@-webkit-keyframes pulse {
  from {
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
  }

  50% {
    -webkit-transform: scale3d(1.05, 1.05, 1.05);
    transform: scale3d(1.05, 1.05, 1.05);
  }

  to {
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
  }
}
@keyframes pulse {
  from {
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
  }

  50% {
    -webkit-transform: scale3d(1.05, 1.05, 1.05);
    transform: scale3d(1.05, 1.05, 1.05);
  }

  to {
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
  }
}
.animate__pulse {
  -webkit-animation-name: pulse;
  animation-name: pulse;
  -webkit-animation-timing-function: ease-in-out;
  animation-timing-function: ease-in-out;
}
@-webkit-keyframes rubberBand {
  from {
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
  }

  30% {
    -webkit-transform: scale3d(1.25, 0.75, 1);
    transform: scale3d(1.25, 0.75, 1);
  }

  40% {
    -webkit-transform: scale3d(0.75, 1.25, 1);
    transform: scale3d(0.75, 1.25, 1);
  }

  50% {
    -webkit-transform: scale3d(1.15, 0.85, 1);
    transform: scale3d(1.15, 0.85, 1);
  }

  65% {
    -webkit-transform: scale3d(0.95, 1.05, 1);
    transform: scale3d(0.95, 1.05, 1);
  }

  75% {
    -webkit-transform: scale3d(1.05, 0.95, 1);
    transform: scale3d(1.05, 0.95, 1);
  }

  to {
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
  }
}
@keyframes rubberBand {
  from {
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
  }

  30% {
    -webkit-transform: scale3d(1.25, 0.75, 1);
    transform: scale3d(1.25, 0.75, 1);
  }

  40% {
    -webkit-transform: scale3d(0.75, 1.25, 1);
    transform: scale3d(0.75, 1.25, 1);
  }

  50% {
    -webkit-transform: scale3d(1.15, 0.85, 1);
    transform: scale3d(1.15, 0.85, 1);
  }

  65% {
    -webkit-transform: scale3d(0.95, 1.05, 1);
    transform: scale3d(0.95, 1.05, 1);
  }

  75% {
    -webkit-transform: scale3d(1.05, 0.95, 1);
    transform: scale3d(1.05, 0.95, 1);
  }

  to {
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
  }
}
.animate__rubberBand {
  -webkit-animation-name: rubberBand;
  animation-name: rubberBand;
}
@-webkit-keyframes shakeX {
  from,
  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }

  10%,
  30%,
  50%,
  70%,
  90% {
    -webkit-transform: translate3d(-10px, 0, 0);
    transform: translate3d(-10px, 0, 0);
  }

  20%,
  40%,
  60%,
  80% {
    -webkit-transform: translate3d(10px, 0, 0);
    transform: translate3d(10px, 0, 0);
  }
}
@keyframes shakeX {
  from,
  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }

  10%,
  30%,
  50%,
  70%,
  90% {
    -webkit-transform: translate3d(-10px, 0, 0);
    transform: translate3d(-10px, 0, 0);
  }

  20%,
  40%,
  60%,
  80% {
    -webkit-transform: translate3d(10px, 0, 0);
    transform: translate3d(10px, 0, 0);
  }
}
.animate__shakeX {
  -webkit-animation-name: shakeX;
  animation-name: shakeX;
}
@-webkit-keyframes shakeY {
  from,
  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }

  10%,
  30%,
  50%,
  70%,
  90% {
    -webkit-transform: translate3d(0, -10px, 0);
    transform: translate3d(0, -10px, 0);
  }

  20%,
  40%,
  60%,
  80% {
    -webkit-transform: translate3d(0, 10px, 0);
    transform: translate3d(0, 10px, 0);
  }
}
@keyframes shakeY {
  from,
  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }

  10%,
  30%,
  50%,
  70%,
  90% {
    -webkit-transform: translate3d(0, -10px, 0);
    transform: translate3d(0, -10px, 0);
  }

  20%,
  40%,
  60%,
  80% {
    -webkit-transform: translate3d(0, 10px, 0);
    transform: translate3d(0, 10px, 0);
  }
}
.animate__shakeY {
  -webkit-animation-name: shakeY;
  animation-name: shakeY;
}
@-webkit-keyframes headShake {
  0% {
    -webkit-transform: translateX(0);
    transform: translateX(0);
  }

  6.5% {
    -webkit-transform: translateX(-6px) rotateY(-9deg);
    transform: translateX(-6px) rotateY(-9deg);
  }

  18.5% {
    -webkit-transform: translateX(5px) rotateY(7deg);
    transform: translateX(5px) rotateY(7deg);
  }

  31.5% {
    -webkit-transform: translateX(-3px) rotateY(-5deg);
    transform: translateX(-3px) rotateY(-5deg);
  }

  43.5% {
    -webkit-transform: translateX(2px) rotateY(3deg);
    transform: translateX(2px) rotateY(3deg);
  }

  50% {
    -webkit-transform: translateX(0);
    transform: translateX(0);
  }
}
@keyframes headShake {
  0% {
    -webkit-transform: translateX(0);
    transform: translateX(0);
  }

  6.5% {
    -webkit-transform: translateX(-6px) rotateY(-9deg);
    transform: translateX(-6px) rotateY(-9deg);
  }

  18.5% {
    -webkit-transform: translateX(5px) rotateY(7deg);
    transform: translateX(5px) rotateY(7deg);
  }

  31.5% {
    -webkit-transform: translateX(-3px) rotateY(-5deg);
    transform: translateX(-3px) rotateY(-5deg);
  }

  43.5% {
    -webkit-transform: translateX(2px) rotateY(3deg);
    transform: translateX(2px) rotateY(3deg);
  }

  50% {
    -webkit-transform: translateX(0);
    transform: translateX(0);
  }
}
.animate__headShake {
  -webkit-animation-timing-function: ease-in-out;
  animation-timing-function: ease-in-out;
  -webkit-animation-name: headShake;
  animation-name: headShake;
}
@-webkit-keyframes swing {
  20% {
    -webkit-transform: rotate3d(0, 0, 1, 15deg);
    transform: rotate3d(0, 0, 1, 15deg);
  }

  40% {
    -webkit-transform: rotate3d(0, 0, 1, -10deg);
    transform: rotate3d(0, 0, 1, -10deg);
  }

  60% {
    -webkit-transform: rotate3d(0, 0, 1, 5deg);
    transform: rotate3d(0, 0, 1, 5deg);
  }

  80% {
    -webkit-transform: rotate3d(0, 0, 1, -5deg);
    transform: rotate3d(0, 0, 1, -5deg);
  }

  to {
    -webkit-transform: rotate3d(0, 0, 1, 0deg);
    transform: rotate3d(0, 0, 1, 0deg);
  }
}
@keyframes swing {
  20% {
    -webkit-transform: rotate3d(0, 0, 1, 15deg);
    transform: rotate3d(0, 0, 1, 15deg);
  }

  40% {
    -webkit-transform: rotate3d(0, 0, 1, -10deg);
    transform: rotate3d(0, 0, 1, -10deg);
  }

  60% {
    -webkit-transform: rotate3d(0, 0, 1, 5deg);
    transform: rotate3d(0, 0, 1, 5deg);
  }

  80% {
    -webkit-transform: rotate3d(0, 0, 1, -5deg);
    transform: rotate3d(0, 0, 1, -5deg);
  }

  to {
    -webkit-transform: rotate3d(0, 0, 1, 0deg);
    transform: rotate3d(0, 0, 1, 0deg);
  }
}
.animate__swing {
  -webkit-transform-origin: top center;
  transform-origin: top center;
  -webkit-animation-name: swing;
  animation-name: swing;
}
@-webkit-keyframes tada {
  from {
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
  }

  10%,
  20% {
    -webkit-transform: scale3d(0.9, 0.9, 0.9) rotate3d(0, 0, 1, -3deg);
    transform: scale3d(0.9, 0.9, 0.9) rotate3d(0, 0, 1, -3deg);
  }

  30%,
  50%,
  70%,
  90% {
    -webkit-transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, 3deg);
    transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, 3deg);
  }

  40%,
  60%,
  80% {
    -webkit-transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, -3deg);
    transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, -3deg);
  }

  to {
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
  }
}
@keyframes tada {
  from {
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
  }

  10%,
  20% {
    -webkit-transform: scale3d(0.9, 0.9, 0.9) rotate3d(0, 0, 1, -3deg);
    transform: scale3d(0.9, 0.9, 0.9) rotate3d(0, 0, 1, -3deg);
  }

  30%,
  50%,
  70%,
  90% {
    -webkit-transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, 3deg);
    transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, 3deg);
  }

  40%,
  60%,
  80% {
    -webkit-transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, -3deg);
    transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, -3deg);
  }

  to {
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
  }
}
.animate__tada {
  -webkit-animation-name: tada;
  animation-name: tada;
}
/* originally authored by Nick Pettit - https://github.com/nickpettit/glide */
@-webkit-keyframes wobble {
  from {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }

  15% {
    -webkit-transform: translate3d(-25%, 0, 0) rotate3d(0, 0, 1, -5deg);
    transform: translate3d(-25%, 0, 0) rotate3d(0, 0, 1, -5deg);
  }

  30% {
    -webkit-transform: translate3d(20%, 0, 0) rotate3d(0, 0, 1, 3deg);
    transform: translate3d(20%, 0, 0) rotate3d(0, 0, 1, 3deg);
  }

  45% {
    -webkit-transform: translate3d(-15%, 0, 0) rotate3d(0, 0, 1, -3deg);
    transform: translate3d(-15%, 0, 0) rotate3d(0, 0, 1, -3deg);
  }

  60% {
    -webkit-transform: translate3d(10%, 0, 0) rotate3d(0, 0, 1, 2deg);
    transform: translate3d(10%, 0, 0) rotate3d(0, 0, 1, 2deg);
  }

  75% {
    -webkit-transform: translate3d(-5%, 0, 0) rotate3d(0, 0, 1, -1deg);
    transform: translate3d(-5%, 0, 0) rotate3d(0, 0, 1, -1deg);
  }

  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
@keyframes wobble {
  from {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }

  15% {
    -webkit-transform: translate3d(-25%, 0, 0) rotate3d(0, 0, 1, -5deg);
    transform: translate3d(-25%, 0, 0) rotate3d(0, 0, 1, -5deg);
  }

  30% {
    -webkit-transform: translate3d(20%, 0, 0) rotate3d(0, 0, 1, 3deg);
    transform: translate3d(20%, 0, 0) rotate3d(0, 0, 1, 3deg);
  }

  45% {
    -webkit-transform: translate3d(-15%, 0, 0) rotate3d(0, 0, 1, -3deg);
    transform: translate3d(-15%, 0, 0) rotate3d(0, 0, 1, -3deg);
  }

  60% {
    -webkit-transform: translate3d(10%, 0, 0) rotate3d(0, 0, 1, 2deg);
    transform: translate3d(10%, 0, 0) rotate3d(0, 0, 1, 2deg);
  }

  75% {
    -webkit-transform: translate3d(-5%, 0, 0) rotate3d(0, 0, 1, -1deg);
    transform: translate3d(-5%, 0, 0) rotate3d(0, 0, 1, -1deg);
  }

  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
.animate__wobble {
  -webkit-animation-name: wobble;
  animation-name: wobble;
}
@-webkit-keyframes jello {
  from,
  11.1%,
  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }

  22.2% {
    -webkit-transform: skewX(-12.5deg) skewY(-12.5deg);
    transform: skewX(-12.5deg) skewY(-12.5deg);
  }

  33.3% {
    -webkit-transform: skewX(6.25deg) skewY(6.25deg);
    transform: skewX(6.25deg) skewY(6.25deg);
  }

  44.4% {
    -webkit-transform: skewX(-3.125deg) skewY(-3.125deg);
    transform: skewX(-3.125deg) skewY(-3.125deg);
  }

  55.5% {
    -webkit-transform: skewX(1.5625deg) skewY(1.5625deg);
    transform: skewX(1.5625deg) skewY(1.5625deg);
  }

  66.6% {
    -webkit-transform: skewX(-0.78125deg) skewY(-0.78125deg);
    transform: skewX(-0.78125deg) skewY(-0.78125deg);
  }

  77.7% {
    -webkit-transform: skewX(0.390625deg) skewY(0.390625deg);
    transform: skewX(0.390625deg) skewY(0.390625deg);
  }

  88.8% {
    -webkit-transform: skewX(-0.1953125deg) skewY(-0.1953125deg);
    transform: skewX(-0.1953125deg) skewY(-0.1953125deg);
  }
}
@keyframes jello {
  from,
  11.1%,
  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }

  22.2% {
    -webkit-transform: skewX(-12.5deg) skewY(-12.5deg);
    transform: skewX(-12.5deg) skewY(-12.5deg);
  }

  33.3% {
    -webkit-transform: skewX(6.25deg) skewY(6.25deg);
    transform: skewX(6.25deg) skewY(6.25deg);
  }

  44.4% {
    -webkit-transform: skewX(-3.125deg) skewY(-3.125deg);
    transform: skewX(-3.125deg) skewY(-3.125deg);
  }

  55.5% {
    -webkit-transform: skewX(1.5625deg) skewY(1.5625deg);
    transform: skewX(1.5625deg) skewY(1.5625deg);
  }

  66.6% {
    -webkit-transform: skewX(-0.78125deg) skewY(-0.78125deg);
    transform: skewX(-0.78125deg) skewY(-0.78125deg);
  }

  77.7% {
    -webkit-transform: skewX(0.390625deg) skewY(0.390625deg);
    transform: skewX(0.390625deg) skewY(0.390625deg);
  }

  88.8% {
    -webkit-transform: skewX(-0.1953125deg) skewY(-0.1953125deg);
    transform: skewX(-0.1953125deg) skewY(-0.1953125deg);
  }
}
.animate__jello {
  -webkit-animation-name: jello;
  animation-name: jello;
  -webkit-transform-origin: center;
  transform-origin: center;
}
@-webkit-keyframes heartBeat {
  0% {
    -webkit-transform: scale(1);
    transform: scale(1);
  }

  14% {
    -webkit-transform: scale(1.3);
    transform: scale(1.3);
  }

  28% {
    -webkit-transform: scale(1);
    transform: scale(1);
  }

  42% {
    -webkit-transform: scale(1.3);
    transform: scale(1.3);
  }

  70% {
    -webkit-transform: scale(1);
    transform: scale(1);
  }
}
@keyframes heartBeat {
  0% {
    -webkit-transform: scale(1);
    transform: scale(1);
  }

  14% {
    -webkit-transform: scale(1.3);
    transform: scale(1.3);
  }

  28% {
    -webkit-transform: scale(1);
    transform: scale(1);
  }

  42% {
    -webkit-transform: scale(1.3);
    transform: scale(1.3);
  }

  70% {
    -webkit-transform: scale(1);
    transform: scale(1);
  }
}
.animate__heartBeat {
  -webkit-animation-name: heartBeat;
  animation-name: heartBeat;
  -webkit-animation-duration: calc(1s * 1.3);
  animation-duration: calc(1s * 1.3);
  -webkit-animation-duration: calc(var(--animate-duration) * 1.3);
  animation-duration: calc(var(--animate-duration) * 1.3);
  -webkit-animation-timing-function: ease-in-out;
  animation-timing-function: ease-in-out;
}
/* Back entrances */
@-webkit-keyframes backInDown {
  0% {
    -webkit-transform: translateY(-1200px) scale(0.7);
    transform: translateY(-1200px) scale(0.7);
    opacity: 0.7;
  }

  80% {
    -webkit-transform: translateY(0px) scale(0.7);
    transform: translateY(0px) scale(0.7);
    opacity: 0.7;
  }

  100% {
    -webkit-transform: scale(1);
    transform: scale(1);
    opacity: 1;
  }
}
@keyframes backInDown {
  0% {
    -webkit-transform: translateY(-1200px) scale(0.7);
    transform: translateY(-1200px) scale(0.7);
    opacity: 0.7;
  }

  80% {
    -webkit-transform: translateY(0px) scale(0.7);
    transform: translateY(0px) scale(0.7);
    opacity: 0.7;
  }

  100% {
    -webkit-transform: scale(1);
    transform: scale(1);
    opacity: 1;
  }
}
.animate__backInDown {
  -webkit-animation-name: backInDown;
  animation-name: backInDown;
}
@-webkit-keyframes backInLeft {
  0% {
    -webkit-transform: translateX(-2000px) scale(0.7);
    transform: translateX(-2000px) scale(0.7);
    opacity: 0.7;
  }

  80% {
    -webkit-transform: translateX(0px) scale(0.7);
    transform: translateX(0px) scale(0.7);
    opacity: 0.7;
  }

  100% {
    -webkit-transform: scale(1);
    transform: scale(1);
    opacity: 1;
  }
}
@keyframes backInLeft {
  0% {
    -webkit-transform: translateX(-2000px) scale(0.7);
    transform: translateX(-2000px) scale(0.7);
    opacity: 0.7;
  }

  80% {
    -webkit-transform: translateX(0px) scale(0.7);
    transform: translateX(0px) scale(0.7);
    opacity: 0.7;
  }

  100% {
    -webkit-transform: scale(1);
    transform: scale(1);
    opacity: 1;
  }
}
.animate__backInLeft {
  -webkit-animation-name: backInLeft;
  animation-name: backInLeft;
}
@-webkit-keyframes backInRight {
  0% {
    -webkit-transform: translateX(2000px) scale(0.7);
    transform: translateX(2000px) scale(0.7);
    opacity: 0.7;
  }

  80% {
    -webkit-transform: translateX(0px) scale(0.7);
    transform: translateX(0px) scale(0.7);
    opacity: 0.7;
  }

  100% {
    -webkit-transform: scale(1);
    transform: scale(1);
    opacity: 1;
  }
}
@keyframes backInRight {
  0% {
    -webkit-transform: translateX(2000px) scale(0.7);
    transform: translateX(2000px) scale(0.7);
    opacity: 0.7;
  }

  80% {
    -webkit-transform: translateX(0px) scale(0.7);
    transform: translateX(0px) scale(0.7);
    opacity: 0.7;
  }

  100% {
    -webkit-transform: scale(1);
    transform: scale(1);
    opacity: 1;
  }
}
.animate__backInRight {
  -webkit-animation-name: backInRight;
  animation-name: backInRight;
}
@-webkit-keyframes backInUp {
  0% {
    -webkit-transform: translateY(1200px) scale(0.7);
    transform: translateY(1200px) scale(0.7);
    opacity: 0.7;
  }

  80% {
    -webkit-transform: translateY(0px) scale(0.7);
    transform: translateY(0px) scale(0.7);
    opacity: 0.7;
  }

  100% {
    -webkit-transform: scale(1);
    transform: scale(1);
    opacity: 1;
  }
}
@keyframes backInUp {
  0% {
    -webkit-transform: translateY(1200px) scale(0.7);
    transform: translateY(1200px) scale(0.7);
    opacity: 0.7;
  }

  80% {
    -webkit-transform: translateY(0px) scale(0.7);
    transform: translateY(0px) scale(0.7);
    opacity: 0.7;
  }

  100% {
    -webkit-transform: scale(1);
    transform: scale(1);
    opacity: 1;
  }
}
.animate__backInUp {
  -webkit-animation-name: backInUp;
  animation-name: backInUp;
}
/* Back exits */
@-webkit-keyframes backOutDown {
  0% {
    -webkit-transform: scale(1);
    transform: scale(1);
    opacity: 1;
  }

  20% {
    -webkit-transform: translateY(0px) scale(0.7);
    transform: translateY(0px) scale(0.7);
    opacity: 0.7;
  }

  100% {
    -webkit-transform: translateY(700px) scale(0.7);
    transform: translateY(700px) scale(0.7);
    opacity: 0.7;
  }
}
@keyframes backOutDown {
  0% {
    -webkit-transform: scale(1);
    transform: scale(1);
    opacity: 1;
  }

  20% {
    -webkit-transform: translateY(0px) scale(0.7);
    transform: translateY(0px) scale(0.7);
    opacity: 0.7;
  }

  100% {
    -webkit-transform: translateY(700px) scale(0.7);
    transform: translateY(700px) scale(0.7);
    opacity: 0.7;
  }
}
.animate__backOutDown {
  -webkit-animation-name: backOutDown;
  animation-name: backOutDown;
}
@-webkit-keyframes backOutLeft {
  0% {
    -webkit-transform: scale(1);
    transform: scale(1);
    opacity: 1;
  }

  20% {
    -webkit-transform: translateX(0px) scale(0.7);
    transform: translateX(0px) scale(0.7);
    opacity: 0.7;
  }

  100% {
    -webkit-transform: translateX(-2000px) scale(0.7);
    transform: translateX(-2000px) scale(0.7);
    opacity: 0.7;
  }
}
@keyframes backOutLeft {
  0% {
    -webkit-transform: scale(1);
    transform: scale(1);
    opacity: 1;
  }

  20% {
    -webkit-transform: translateX(0px) scale(0.7);
    transform: translateX(0px) scale(0.7);
    opacity: 0.7;
  }

  100% {
    -webkit-transform: translateX(-2000px) scale(0.7);
    transform: translateX(-2000px) scale(0.7);
    opacity: 0.7;
  }
}
.animate__backOutLeft {
  -webkit-animation-name: backOutLeft;
  animation-name: backOutLeft;
}
@-webkit-keyframes backOutRight {
  0% {
    -webkit-transform: scale(1);
    transform: scale(1);
    opacity: 1;
  }

  20% {
    -webkit-transform: translateX(0px) scale(0.7);
    transform: translateX(0px) scale(0.7);
    opacity: 0.7;
  }

  100% {
    -webkit-transform: translateX(2000px) scale(0.7);
    transform: translateX(2000px) scale(0.7);
    opacity: 0.7;
  }
}
@keyframes backOutRight {
  0% {
    -webkit-transform: scale(1);
    transform: scale(1);
    opacity: 1;
  }

  20% {
    -webkit-transform: translateX(0px) scale(0.7);
    transform: translateX(0px) scale(0.7);
    opacity: 0.7;
  }

  100% {
    -webkit-transform: translateX(2000px) scale(0.7);
    transform: translateX(2000px) scale(0.7);
    opacity: 0.7;
  }
}
.animate__backOutRight {
  -webkit-animation-name: backOutRight;
  animation-name: backOutRight;
}
@-webkit-keyframes backOutUp {
  0% {
    -webkit-transform: scale(1);
    transform: scale(1);
    opacity: 1;
  }

  20% {
    -webkit-transform: translateY(0px) scale(0.7);
    transform: translateY(0px) scale(0.7);
    opacity: 0.7;
  }

  100% {
    -webkit-transform: translateY(-700px) scale(0.7);
    transform: translateY(-700px) scale(0.7);
    opacity: 0.7;
  }
}
@keyframes backOutUp {
  0% {
    -webkit-transform: scale(1);
    transform: scale(1);
    opacity: 1;
  }

  20% {
    -webkit-transform: translateY(0px) scale(0.7);
    transform: translateY(0px) scale(0.7);
    opacity: 0.7;
  }

  100% {
    -webkit-transform: translateY(-700px) scale(0.7);
    transform: translateY(-700px) scale(0.7);
    opacity: 0.7;
  }
}
.animate__backOutUp {
  -webkit-animation-name: backOutUp;
  animation-name: backOutUp;
}
/* Bouncing entrances  */
@-webkit-keyframes bounceIn {
  from,
  20%,
  40%,
  60%,
  80%,
  to {
    -webkit-animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
    animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
  }

  0% {
    opacity: 0;
    -webkit-transform: scale3d(0.3, 0.3, 0.3);
    transform: scale3d(0.3, 0.3, 0.3);
  }

  20% {
    -webkit-transform: scale3d(1.1, 1.1, 1.1);
    transform: scale3d(1.1, 1.1, 1.1);
  }

  40% {
    -webkit-transform: scale3d(0.9, 0.9, 0.9);
    transform: scale3d(0.9, 0.9, 0.9);
  }

  60% {
    opacity: 1;
    -webkit-transform: scale3d(1.03, 1.03, 1.03);
    transform: scale3d(1.03, 1.03, 1.03);
  }

  80% {
    -webkit-transform: scale3d(0.97, 0.97, 0.97);
    transform: scale3d(0.97, 0.97, 0.97);
  }

  to {
    opacity: 1;
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
  }
}
@keyframes bounceIn {
  from,
  20%,
  40%,
  60%,
  80%,
  to {
    -webkit-animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
    animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
  }

  0% {
    opacity: 0;
    -webkit-transform: scale3d(0.3, 0.3, 0.3);
    transform: scale3d(0.3, 0.3, 0.3);
  }

  20% {
    -webkit-transform: scale3d(1.1, 1.1, 1.1);
    transform: scale3d(1.1, 1.1, 1.1);
  }

  40% {
    -webkit-transform: scale3d(0.9, 0.9, 0.9);
    transform: scale3d(0.9, 0.9, 0.9);
  }

  60% {
    opacity: 1;
    -webkit-transform: scale3d(1.03, 1.03, 1.03);
    transform: scale3d(1.03, 1.03, 1.03);
  }

  80% {
    -webkit-transform: scale3d(0.97, 0.97, 0.97);
    transform: scale3d(0.97, 0.97, 0.97);
  }

  to {
    opacity: 1;
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
  }
}
.animate__bounceIn {
  -webkit-animation-duration: calc(1s * 0.75);
  animation-duration: calc(1s * 0.75);
  -webkit-animation-duration: calc(var(--animate-duration) * 0.75);
  animation-duration: calc(var(--animate-duration) * 0.75);
  -webkit-animation-name: bounceIn;
  animation-name: bounceIn;
}
@-webkit-keyframes bounceInDown {
  from,
  60%,
  75%,
  90%,
  to {
    -webkit-animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
    animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
  }

  0% {
    opacity: 0;
    -webkit-transform: translate3d(0, -3000px, 0) scaleY(3);
    transform: translate3d(0, -3000px, 0) scaleY(3);
  }

  60% {
    opacity: 1;
    -webkit-transform: translate3d(0, 25px, 0) scaleY(0.9);
    transform: translate3d(0, 25px, 0) scaleY(0.9);
  }

  75% {
    -webkit-transform: translate3d(0, -10px, 0) scaleY(0.95);
    transform: translate3d(0, -10px, 0) scaleY(0.95);
  }

  90% {
    -webkit-transform: translate3d(0, 5px, 0) scaleY(0.985);
    transform: translate3d(0, 5px, 0) scaleY(0.985);
  }

  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
@keyframes bounceInDown {
  from,
  60%,
  75%,
  90%,
  to {
    -webkit-animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
    animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
  }

  0% {
    opacity: 0;
    -webkit-transform: translate3d(0, -3000px, 0) scaleY(3);
    transform: translate3d(0, -3000px, 0) scaleY(3);
  }

  60% {
    opacity: 1;
    -webkit-transform: translate3d(0, 25px, 0) scaleY(0.9);
    transform: translate3d(0, 25px, 0) scaleY(0.9);
  }

  75% {
    -webkit-transform: translate3d(0, -10px, 0) scaleY(0.95);
    transform: translate3d(0, -10px, 0) scaleY(0.95);
  }

  90% {
    -webkit-transform: translate3d(0, 5px, 0) scaleY(0.985);
    transform: translate3d(0, 5px, 0) scaleY(0.985);
  }

  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
.animate__bounceInDown {
  -webkit-animation-name: bounceInDown;
  animation-name: bounceInDown;
}
@-webkit-keyframes bounceInLeft {
  from,
  60%,
  75%,
  90%,
  to {
    -webkit-animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
    animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
  }

  0% {
    opacity: 0;
    -webkit-transform: translate3d(-3000px, 0, 0) scaleX(3);
    transform: translate3d(-3000px, 0, 0) scaleX(3);
  }

  60% {
    opacity: 1;
    -webkit-transform: translate3d(25px, 0, 0) scaleX(1);
    transform: translate3d(25px, 0, 0) scaleX(1);
  }

  75% {
    -webkit-transform: translate3d(-10px, 0, 0) scaleX(0.98);
    transform: translate3d(-10px, 0, 0) scaleX(0.98);
  }

  90% {
    -webkit-transform: translate3d(5px, 0, 0) scaleX(0.995);
    transform: translate3d(5px, 0, 0) scaleX(0.995);
  }

  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
@keyframes bounceInLeft {
  from,
  60%,
  75%,
  90%,
  to {
    -webkit-animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
    animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
  }

  0% {
    opacity: 0;
    -webkit-transform: translate3d(-3000px, 0, 0) scaleX(3);
    transform: translate3d(-3000px, 0, 0) scaleX(3);
  }

  60% {
    opacity: 1;
    -webkit-transform: translate3d(25px, 0, 0) scaleX(1);
    transform: translate3d(25px, 0, 0) scaleX(1);
  }

  75% {
    -webkit-transform: translate3d(-10px, 0, 0) scaleX(0.98);
    transform: translate3d(-10px, 0, 0) scaleX(0.98);
  }

  90% {
    -webkit-transform: translate3d(5px, 0, 0) scaleX(0.995);
    transform: translate3d(5px, 0, 0) scaleX(0.995);
  }

  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
.animate__bounceInLeft {
  -webkit-animation-name: bounceInLeft;
  animation-name: bounceInLeft;
}
@-webkit-keyframes bounceInRight {
  from,
  60%,
  75%,
  90%,
  to {
    -webkit-animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
    animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
  }

  from {
    opacity: 0;
    -webkit-transform: translate3d(3000px, 0, 0) scaleX(3);
    transform: translate3d(3000px, 0, 0) scaleX(3);
  }

  60% {
    opacity: 1;
    -webkit-transform: translate3d(-25px, 0, 0) scaleX(1);
    transform: translate3d(-25px, 0, 0) scaleX(1);
  }

  75% {
    -webkit-transform: translate3d(10px, 0, 0) scaleX(0.98);
    transform: translate3d(10px, 0, 0) scaleX(0.98);
  }

  90% {
    -webkit-transform: translate3d(-5px, 0, 0) scaleX(0.995);
    transform: translate3d(-5px, 0, 0) scaleX(0.995);
  }

  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
@keyframes bounceInRight {
  from,
  60%,
  75%,
  90%,
  to {
    -webkit-animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
    animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
  }

  from {
    opacity: 0;
    -webkit-transform: translate3d(3000px, 0, 0) scaleX(3);
    transform: translate3d(3000px, 0, 0) scaleX(3);
  }

  60% {
    opacity: 1;
    -webkit-transform: translate3d(-25px, 0, 0) scaleX(1);
    transform: translate3d(-25px, 0, 0) scaleX(1);
  }

  75% {
    -webkit-transform: translate3d(10px, 0, 0) scaleX(0.98);
    transform: translate3d(10px, 0, 0) scaleX(0.98);
  }

  90% {
    -webkit-transform: translate3d(-5px, 0, 0) scaleX(0.995);
    transform: translate3d(-5px, 0, 0) scaleX(0.995);
  }

  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
.animate__bounceInRight {
  -webkit-animation-name: bounceInRight;
  animation-name: bounceInRight;
}
@-webkit-keyframes bounceInUp {
  from,
  60%,
  75%,
  90%,
  to {
    -webkit-animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
    animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
  }

  from {
    opacity: 0;
    -webkit-transform: translate3d(0, 3000px, 0) scaleY(5);
    transform: translate3d(0, 3000px, 0) scaleY(5);
  }

  60% {
    opacity: 1;
    -webkit-transform: translate3d(0, -20px, 0) scaleY(0.9);
    transform: translate3d(0, -20px, 0) scaleY(0.9);
  }

  75% {
    -webkit-transform: translate3d(0, 10px, 0) scaleY(0.95);
    transform: translate3d(0, 10px, 0) scaleY(0.95);
  }

  90% {
    -webkit-transform: translate3d(0, -5px, 0) scaleY(0.985);
    transform: translate3d(0, -5px, 0) scaleY(0.985);
  }

  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
@keyframes bounceInUp {
  from,
  60%,
  75%,
  90%,
  to {
    -webkit-animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
    animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
  }

  from {
    opacity: 0;
    -webkit-transform: translate3d(0, 3000px, 0) scaleY(5);
    transform: translate3d(0, 3000px, 0) scaleY(5);
  }

  60% {
    opacity: 1;
    -webkit-transform: translate3d(0, -20px, 0) scaleY(0.9);
    transform: translate3d(0, -20px, 0) scaleY(0.9);
  }

  75% {
    -webkit-transform: translate3d(0, 10px, 0) scaleY(0.95);
    transform: translate3d(0, 10px, 0) scaleY(0.95);
  }

  90% {
    -webkit-transform: translate3d(0, -5px, 0) scaleY(0.985);
    transform: translate3d(0, -5px, 0) scaleY(0.985);
  }

  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
.animate__bounceInUp {
  -webkit-animation-name: bounceInUp;
  animation-name: bounceInUp;
}
/* Bouncing exits  */
@-webkit-keyframes bounceOut {
  20% {
    -webkit-transform: scale3d(0.9, 0.9, 0.9);
    transform: scale3d(0.9, 0.9, 0.9);
  }

  50%,
  55% {
    opacity: 1;
    -webkit-transform: scale3d(1.1, 1.1, 1.1);
    transform: scale3d(1.1, 1.1, 1.1);
  }

  to {
    opacity: 0;
    -webkit-transform: scale3d(0.3, 0.3, 0.3);
    transform: scale3d(0.3, 0.3, 0.3);
  }
}
@keyframes bounceOut {
  20% {
    -webkit-transform: scale3d(0.9, 0.9, 0.9);
    transform: scale3d(0.9, 0.9, 0.9);
  }

  50%,
  55% {
    opacity: 1;
    -webkit-transform: scale3d(1.1, 1.1, 1.1);
    transform: scale3d(1.1, 1.1, 1.1);
  }

  to {
    opacity: 0;
    -webkit-transform: scale3d(0.3, 0.3, 0.3);
    transform: scale3d(0.3, 0.3, 0.3);
  }
}
.animate__bounceOut {
  -webkit-animation-duration: calc(1s * 0.75);
  animation-duration: calc(1s * 0.75);
  -webkit-animation-duration: calc(var(--animate-duration) * 0.75);
  animation-duration: calc(var(--animate-duration) * 0.75);
  -webkit-animation-name: bounceOut;
  animation-name: bounceOut;
}
@-webkit-keyframes bounceOutDown {
  20% {
    -webkit-transform: translate3d(0, 10px, 0) scaleY(0.985);
    transform: translate3d(0, 10px, 0) scaleY(0.985);
  }

  40%,
  45% {
    opacity: 1;
    -webkit-transform: translate3d(0, -20px, 0) scaleY(0.9);
    transform: translate3d(0, -20px, 0) scaleY(0.9);
  }

  to {
    opacity: 0;
    -webkit-transform: translate3d(0, 2000px, 0) scaleY(3);
    transform: translate3d(0, 2000px, 0) scaleY(3);
  }
}
@keyframes bounceOutDown {
  20% {
    -webkit-transform: translate3d(0, 10px, 0) scaleY(0.985);
    transform: translate3d(0, 10px, 0) scaleY(0.985);
  }

  40%,
  45% {
    opacity: 1;
    -webkit-transform: translate3d(0, -20px, 0) scaleY(0.9);
    transform: translate3d(0, -20px, 0) scaleY(0.9);
  }

  to {
    opacity: 0;
    -webkit-transform: translate3d(0, 2000px, 0) scaleY(3);
    transform: translate3d(0, 2000px, 0) scaleY(3);
  }
}
.animate__bounceOutDown {
  -webkit-animation-name: bounceOutDown;
  animation-name: bounceOutDown;
}
@-webkit-keyframes bounceOutLeft {
  20% {
    opacity: 1;
    -webkit-transform: translate3d(20px, 0, 0) scaleX(0.9);
    transform: translate3d(20px, 0, 0) scaleX(0.9);
  }

  to {
    opacity: 0;
    -webkit-transform: translate3d(-2000px, 0, 0) scaleX(2);
    transform: translate3d(-2000px, 0, 0) scaleX(2);
  }
}
@keyframes bounceOutLeft {
  20% {
    opacity: 1;
    -webkit-transform: translate3d(20px, 0, 0) scaleX(0.9);
    transform: translate3d(20px, 0, 0) scaleX(0.9);
  }

  to {
    opacity: 0;
    -webkit-transform: translate3d(-2000px, 0, 0) scaleX(2);
    transform: translate3d(-2000px, 0, 0) scaleX(2);
  }
}
.animate__bounceOutLeft {
  -webkit-animation-name: bounceOutLeft;
  animation-name: bounceOutLeft;
}
@-webkit-keyframes bounceOutRight {
  20% {
    opacity: 1;
    -webkit-transform: translate3d(-20px, 0, 0) scaleX(0.9);
    transform: translate3d(-20px, 0, 0) scaleX(0.9);
  }

  to {
    opacity: 0;
    -webkit-transform: translate3d(2000px, 0, 0) scaleX(2);
    transform: translate3d(2000px, 0, 0) scaleX(2);
  }
}
@keyframes bounceOutRight {
  20% {
    opacity: 1;
    -webkit-transform: translate3d(-20px, 0, 0) scaleX(0.9);
    transform: translate3d(-20px, 0, 0) scaleX(0.9);
  }

  to {
    opacity: 0;
    -webkit-transform: translate3d(2000px, 0, 0) scaleX(2);
    transform: translate3d(2000px, 0, 0) scaleX(2);
  }
}
.animate__bounceOutRight {
  -webkit-animation-name: bounceOutRight;
  animation-name: bounceOutRight;
}
@-webkit-keyframes bounceOutUp {
  20% {
    -webkit-transform: translate3d(0, -10px, 0) scaleY(0.985);
    transform: translate3d(0, -10px, 0) scaleY(0.985);
  }

  40%,
  45% {
    opacity: 1;
    -webkit-transform: translate3d(0, 20px, 0) scaleY(0.9);
    transform: translate3d(0, 20px, 0) scaleY(0.9);
  }

  to {
    opacity: 0;
    -webkit-transform: translate3d(0, -2000px, 0) scaleY(3);
    transform: translate3d(0, -2000px, 0) scaleY(3);
  }
}
@keyframes bounceOutUp {
  20% {
    -webkit-transform: translate3d(0, -10px, 0) scaleY(0.985);
    transform: translate3d(0, -10px, 0) scaleY(0.985);
  }

  40%,
  45% {
    opacity: 1;
    -webkit-transform: translate3d(0, 20px, 0) scaleY(0.9);
    transform: translate3d(0, 20px, 0) scaleY(0.9);
  }

  to {
    opacity: 0;
    -webkit-transform: translate3d(0, -2000px, 0) scaleY(3);
    transform: translate3d(0, -2000px, 0) scaleY(3);
  }
}
.animate__bounceOutUp {
  -webkit-animation-name: bounceOutUp;
  animation-name: bounceOutUp;
}
/* Fading entrances  */
@-webkit-keyframes fadeIn {
  from {
    opacity: 0;
  }

  to {
    opacity: 1;
  }
}
@keyframes fadeIn {
  from {
    opacity: 0;
  }

  to {
    opacity: 1;
  }
}
.animate__fadeIn {
  -webkit-animation-name: fadeIn;
  animation-name: fadeIn;
}
@-webkit-keyframes fadeInDown {
  from {
    opacity: 0;
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
  }

  to {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
@keyframes fadeInDown {
  from {
    opacity: 0;
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
  }

  to {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
.animate__fadeInDown {
  -webkit-animation-name: fadeInDown;
  animation-name: fadeInDown;
}
@-webkit-keyframes fadeInDownBig {
  from {
    opacity: 0;
    -webkit-transform: translate3d(0, -2000px, 0);
    transform: translate3d(0, -2000px, 0);
  }

  to {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
@keyframes fadeInDownBig {
  from {
    opacity: 0;
    -webkit-transform: translate3d(0, -2000px, 0);
    transform: translate3d(0, -2000px, 0);
  }

  to {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
.animate__fadeInDownBig {
  -webkit-animation-name: fadeInDownBig;
  animation-name: fadeInDownBig;
}
@-webkit-keyframes fadeInLeft {
  from {
    opacity: 0;
    -webkit-transform: translate3d(-100%, 0, 0);
    transform: translate3d(-100%, 0, 0);
  }

  to {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
@keyframes fadeInLeft {
  from {
    opacity: 0;
    -webkit-transform: translate3d(-100%, 0, 0);
    transform: translate3d(-100%, 0, 0);
  }

  to {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
.animate__fadeInLeft {
  -webkit-animation-name: fadeInLeft;
  animation-name: fadeInLeft;
}
@-webkit-keyframes fadeInLeftBig {
  from {
    opacity: 0;
    -webkit-transform: translate3d(-2000px, 0, 0);
    transform: translate3d(-2000px, 0, 0);
  }

  to {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
@keyframes fadeInLeftBig {
  from {
    opacity: 0;
    -webkit-transform: translate3d(-2000px, 0, 0);
    transform: translate3d(-2000px, 0, 0);
  }

  to {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
.animate__fadeInLeftBig {
  -webkit-animation-name: fadeInLeftBig;
  animation-name: fadeInLeftBig;
}
@-webkit-keyframes fadeInRight {
  from {
    opacity: 0;
    -webkit-transform: translate3d(100%, 0, 0);
    transform: translate3d(100%, 0, 0);
  }

  to {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
@keyframes fadeInRight {
  from {
    opacity: 0;
    -webkit-transform: translate3d(100%, 0, 0);
    transform: translate3d(100%, 0, 0);
  }

  to {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
.animate__fadeInRight {
  -webkit-animation-name: fadeInRight;
  animation-name: fadeInRight;
}
@-webkit-keyframes fadeInRightBig {
  from {
    opacity: 0;
    -webkit-transform: translate3d(2000px, 0, 0);
    transform: translate3d(2000px, 0, 0);
  }

  to {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
@keyframes fadeInRightBig {
  from {
    opacity: 0;
    -webkit-transform: translate3d(2000px, 0, 0);
    transform: translate3d(2000px, 0, 0);
  }

  to {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
.animate__fadeInRightBig {
  -webkit-animation-name: fadeInRightBig;
  animation-name: fadeInRightBig;
}
@-webkit-keyframes fadeInUp {
  from {
    opacity: 0;
    -webkit-transform: translate3d(0, 100%, 0);
    transform: translate3d(0, 100%, 0);
  }

  to {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
@keyframes fadeInUp {
  from {
    opacity: 0;
    -webkit-transform: translate3d(0, 100%, 0);
    transform: translate3d(0, 100%, 0);
  }

  to {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
.animate__fadeInUp {
  -webkit-animation-name: fadeInUp;
  animation-name: fadeInUp;
}
@-webkit-keyframes fadeInUpBig {
  from {
    opacity: 0;
    -webkit-transform: translate3d(0, 2000px, 0);
    transform: translate3d(0, 2000px, 0);
  }

  to {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
@keyframes fadeInUpBig {
  from {
    opacity: 0;
    -webkit-transform: translate3d(0, 2000px, 0);
    transform: translate3d(0, 2000px, 0);
  }

  to {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
.animate__fadeInUpBig {
  -webkit-animation-name: fadeInUpBig;
  animation-name: fadeInUpBig;
}
@-webkit-keyframes fadeInTopLeft {
  from {
    opacity: 0;
    -webkit-transform: translate3d(-100%, -100%, 0);
    transform: translate3d(-100%, -100%, 0);
  }
  to {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
@keyframes fadeInTopLeft {
  from {
    opacity: 0;
    -webkit-transform: translate3d(-100%, -100%, 0);
    transform: translate3d(-100%, -100%, 0);
  }
  to {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
.animate__fadeInTopLeft {
  -webkit-animation-name: fadeInTopLeft;
  animation-name: fadeInTopLeft;
}
@-webkit-keyframes fadeInTopRight {
  from {
    opacity: 0;
    -webkit-transform: translate3d(100%, -100%, 0);
    transform: translate3d(100%, -100%, 0);
  }
  to {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
@keyframes fadeInTopRight {
  from {
    opacity: 0;
    -webkit-transform: translate3d(100%, -100%, 0);
    transform: translate3d(100%, -100%, 0);
  }
  to {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
.animate__fadeInTopRight {
  -webkit-animation-name: fadeInTopRight;
  animation-name: fadeInTopRight;
}
@-webkit-keyframes fadeInBottomLeft {
  from {
    opacity: 0;
    -webkit-transform: translate3d(-100%, 100%, 0);
    transform: translate3d(-100%, 100%, 0);
  }
  to {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
@keyframes fadeInBottomLeft {
  from {
    opacity: 0;
    -webkit-transform: translate3d(-100%, 100%, 0);
    transform: translate3d(-100%, 100%, 0);
  }
  to {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
.animate__fadeInBottomLeft {
  -webkit-animation-name: fadeInBottomLeft;
  animation-name: fadeInBottomLeft;
}
@-webkit-keyframes fadeInBottomRight {
  from {
    opacity: 0;
    -webkit-transform: translate3d(100%, 100%, 0);
    transform: translate3d(100%, 100%, 0);
  }
  to {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
@keyframes fadeInBottomRight {
  from {
    opacity: 0;
    -webkit-transform: translate3d(100%, 100%, 0);
    transform: translate3d(100%, 100%, 0);
  }
  to {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
.animate__fadeInBottomRight {
  -webkit-animation-name: fadeInBottomRight;
  animation-name: fadeInBottomRight;
}
/* Fading exits */
@-webkit-keyframes fadeOut {
  from {
    opacity: 1;
  }

  to {
    opacity: 0;
  }
}
@keyframes fadeOut {
  from {
    opacity: 1;
  }

  to {
    opacity: 0;
  }
}
.animate__fadeOut {
  -webkit-animation-name: fadeOut;
  animation-name: fadeOut;
}
@-webkit-keyframes fadeOutDown {
  from {
    opacity: 1;
  }

  to {
    opacity: 0;
    -webkit-transform: translate3d(0, 100%, 0);
    transform: translate3d(0, 100%, 0);
  }
}
@keyframes fadeOutDown {
  from {
    opacity: 1;
  }

  to {
    opacity: 0;
    -webkit-transform: translate3d(0, 100%, 0);
    transform: translate3d(0, 100%, 0);
  }
}
.animate__fadeOutDown {
  -webkit-animation-name: fadeOutDown;
  animation-name: fadeOutDown;
}
@-webkit-keyframes fadeOutDownBig {
  from {
    opacity: 1;
  }

  to {
    opacity: 0;
    -webkit-transform: translate3d(0, 2000px, 0);
    transform: translate3d(0, 2000px, 0);
  }
}
@keyframes fadeOutDownBig {
  from {
    opacity: 1;
  }

  to {
    opacity: 0;
    -webkit-transform: translate3d(0, 2000px, 0);
    transform: translate3d(0, 2000px, 0);
  }
}
.animate__fadeOutDownBig {
  -webkit-animation-name: fadeOutDownBig;
  animation-name: fadeOutDownBig;
}
@-webkit-keyframes fadeOutLeft {
  from {
    opacity: 1;
  }

  to {
    opacity: 0;
    -webkit-transform: translate3d(-100%, 0, 0);
    transform: translate3d(-100%, 0, 0);
  }
}
@keyframes fadeOutLeft {
  from {
    opacity: 1;
  }

  to {
    opacity: 0;
    -webkit-transform: translate3d(-100%, 0, 0);
    transform: translate3d(-100%, 0, 0);
  }
}
.animate__fadeOutLeft {
  -webkit-animation-name: fadeOutLeft;
  animation-name: fadeOutLeft;
}
@-webkit-keyframes fadeOutLeftBig {
  from {
    opacity: 1;
  }

  to {
    opacity: 0;
    -webkit-transform: translate3d(-2000px, 0, 0);
    transform: translate3d(-2000px, 0, 0);
  }
}
@keyframes fadeOutLeftBig {
  from {
    opacity: 1;
  }

  to {
    opacity: 0;
    -webkit-transform: translate3d(-2000px, 0, 0);
    transform: translate3d(-2000px, 0, 0);
  }
}
.animate__fadeOutLeftBig {
  -webkit-animation-name: fadeOutLeftBig;
  animation-name: fadeOutLeftBig;
}
@-webkit-keyframes fadeOutRight {
  from {
    opacity: 1;
  }

  to {
    opacity: 0;
    -webkit-transform: translate3d(100%, 0, 0);
    transform: translate3d(100%, 0, 0);
  }
}
@keyframes fadeOutRight {
  from {
    opacity: 1;
  }

  to {
    opacity: 0;
    -webkit-transform: translate3d(100%, 0, 0);
    transform: translate3d(100%, 0, 0);
  }
}
.animate__fadeOutRight {
  -webkit-animation-name: fadeOutRight;
  animation-name: fadeOutRight;
}
@-webkit-keyframes fadeOutRightBig {
  from {
    opacity: 1;
  }

  to {
    opacity: 0;
    -webkit-transform: translate3d(2000px, 0, 0);
    transform: translate3d(2000px, 0, 0);
  }
}
@keyframes fadeOutRightBig {
  from {
    opacity: 1;
  }

  to {
    opacity: 0;
    -webkit-transform: translate3d(2000px, 0, 0);
    transform: translate3d(2000px, 0, 0);
  }
}
.animate__fadeOutRightBig {
  -webkit-animation-name: fadeOutRightBig;
  animation-name: fadeOutRightBig;
}
@-webkit-keyframes fadeOutUp {
  from {
    opacity: 1;
  }

  to {
    opacity: 0;
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
  }
}
@keyframes fadeOutUp {
  from {
    opacity: 1;
  }

  to {
    opacity: 0;
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
  }
}
.animate__fadeOutUp {
  -webkit-animation-name: fadeOutUp;
  animation-name: fadeOutUp;
}
@-webkit-keyframes fadeOutUpBig {
  from {
    opacity: 1;
  }

  to {
    opacity: 0;
    -webkit-transform: translate3d(0, -2000px, 0);
    transform: translate3d(0, -2000px, 0);
  }
}
@keyframes fadeOutUpBig {
  from {
    opacity: 1;
  }

  to {
    opacity: 0;
    -webkit-transform: translate3d(0, -2000px, 0);
    transform: translate3d(0, -2000px, 0);
  }
}
.animate__fadeOutUpBig {
  -webkit-animation-name: fadeOutUpBig;
  animation-name: fadeOutUpBig;
}
@-webkit-keyframes fadeOutTopLeft {
  from {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
  to {
    opacity: 0;
    -webkit-transform: translate3d(-100%, -100%, 0);
    transform: translate3d(-100%, -100%, 0);
  }
}
@keyframes fadeOutTopLeft {
  from {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
  to {
    opacity: 0;
    -webkit-transform: translate3d(-100%, -100%, 0);
    transform: translate3d(-100%, -100%, 0);
  }
}
.animate__fadeOutTopLeft {
  -webkit-animation-name: fadeOutTopLeft;
  animation-name: fadeOutTopLeft;
}
@-webkit-keyframes fadeOutTopRight {
  from {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
  to {
    opacity: 0;
    -webkit-transform: translate3d(100%, -100%, 0);
    transform: translate3d(100%, -100%, 0);
  }
}
@keyframes fadeOutTopRight {
  from {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
  to {
    opacity: 0;
    -webkit-transform: translate3d(100%, -100%, 0);
    transform: translate3d(100%, -100%, 0);
  }
}
.animate__fadeOutTopRight {
  -webkit-animation-name: fadeOutTopRight;
  animation-name: fadeOutTopRight;
}
@-webkit-keyframes fadeOutBottomRight {
  from {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
  to {
    opacity: 0;
    -webkit-transform: translate3d(100%, 100%, 0);
    transform: translate3d(100%, 100%, 0);
  }
}
@keyframes fadeOutBottomRight {
  from {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
  to {
    opacity: 0;
    -webkit-transform: translate3d(100%, 100%, 0);
    transform: translate3d(100%, 100%, 0);
  }
}
.animate__fadeOutBottomRight {
  -webkit-animation-name: fadeOutBottomRight;
  animation-name: fadeOutBottomRight;
}
@-webkit-keyframes fadeOutBottomLeft {
  from {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
  to {
    opacity: 0;
    -webkit-transform: translate3d(-100%, 100%, 0);
    transform: translate3d(-100%, 100%, 0);
  }
}
@keyframes fadeOutBottomLeft {
  from {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
  to {
    opacity: 0;
    -webkit-transform: translate3d(-100%, 100%, 0);
    transform: translate3d(-100%, 100%, 0);
  }
}
.animate__fadeOutBottomLeft {
  -webkit-animation-name: fadeOutBottomLeft;
  animation-name: fadeOutBottomLeft;
}
/* Flippers */
@-webkit-keyframes flip {
  from {
    -webkit-transform: perspective(400px) scale3d(1, 1, 1) translate3d(0, 0, 0) rotate3d(0, 1, 0, -360deg);
    transform: perspective(400px) scale3d(1, 1, 1) translate3d(0, 0, 0) rotate3d(0, 1, 0, -360deg);
    -webkit-animation-timing-function: ease-out;
    animation-timing-function: ease-out;
  }

  40% {
    -webkit-transform: perspective(400px) scale3d(1, 1, 1) translate3d(0, 0, 150px)
      rotate3d(0, 1, 0, -190deg);
    transform: perspective(400px) scale3d(1, 1, 1) translate3d(0, 0, 150px)
      rotate3d(0, 1, 0, -190deg);
    -webkit-animation-timing-function: ease-out;
    animation-timing-function: ease-out;
  }

  50% {
    -webkit-transform: perspective(400px) scale3d(1, 1, 1) translate3d(0, 0, 150px)
      rotate3d(0, 1, 0, -170deg);
    transform: perspective(400px) scale3d(1, 1, 1) translate3d(0, 0, 150px)
      rotate3d(0, 1, 0, -170deg);
    -webkit-animation-timing-function: ease-in;
    animation-timing-function: ease-in;
  }

  80% {
    -webkit-transform: perspective(400px) scale3d(0.95, 0.95, 0.95) translate3d(0, 0, 0)
      rotate3d(0, 1, 0, 0deg);
    transform: perspective(400px) scale3d(0.95, 0.95, 0.95) translate3d(0, 0, 0)
      rotate3d(0, 1, 0, 0deg);
    -webkit-animation-timing-function: ease-in;
    animation-timing-function: ease-in;
  }

  to {
    -webkit-transform: perspective(400px) scale3d(1, 1, 1) translate3d(0, 0, 0) rotate3d(0, 1, 0, 0deg);
    transform: perspective(400px) scale3d(1, 1, 1) translate3d(0, 0, 0) rotate3d(0, 1, 0, 0deg);
    -webkit-animation-timing-function: ease-in;
    animation-timing-function: ease-in;
  }
}
@keyframes flip {
  from {
    -webkit-transform: perspective(400px) scale3d(1, 1, 1) translate3d(0, 0, 0) rotate3d(0, 1, 0, -360deg);
    transform: perspective(400px) scale3d(1, 1, 1) translate3d(0, 0, 0) rotate3d(0, 1, 0, -360deg);
    -webkit-animation-timing-function: ease-out;
    animation-timing-function: ease-out;
  }

  40% {
    -webkit-transform: perspective(400px) scale3d(1, 1, 1) translate3d(0, 0, 150px)
      rotate3d(0, 1, 0, -190deg);
    transform: perspective(400px) scale3d(1, 1, 1) translate3d(0, 0, 150px)
      rotate3d(0, 1, 0, -190deg);
    -webkit-animation-timing-function: ease-out;
    animation-timing-function: ease-out;
  }

  50% {
    -webkit-transform: perspective(400px) scale3d(1, 1, 1) translate3d(0, 0, 150px)
      rotate3d(0, 1, 0, -170deg);
    transform: perspective(400px) scale3d(1, 1, 1) translate3d(0, 0, 150px)
      rotate3d(0, 1, 0, -170deg);
    -webkit-animation-timing-function: ease-in;
    animation-timing-function: ease-in;
  }

  80% {
    -webkit-transform: perspective(400px) scale3d(0.95, 0.95, 0.95) translate3d(0, 0, 0)
      rotate3d(0, 1, 0, 0deg);
    transform: perspective(400px) scale3d(0.95, 0.95, 0.95) translate3d(0, 0, 0)
      rotate3d(0, 1, 0, 0deg);
    -webkit-animation-timing-function: ease-in;
    animation-timing-function: ease-in;
  }

  to {
    -webkit-transform: perspective(400px) scale3d(1, 1, 1) translate3d(0, 0, 0) rotate3d(0, 1, 0, 0deg);
    transform: perspective(400px) scale3d(1, 1, 1) translate3d(0, 0, 0) rotate3d(0, 1, 0, 0deg);
    -webkit-animation-timing-function: ease-in;
    animation-timing-function: ease-in;
  }
}
.animate__animated.animate__flip {
  -webkit-backface-visibility: visible;
  backface-visibility: visible;
  -webkit-animation-name: flip;
  animation-name: flip;
}
@-webkit-keyframes flipInX {
  from {
    -webkit-transform: perspective(400px) rotate3d(1, 0, 0, 90deg);
    transform: perspective(400px) rotate3d(1, 0, 0, 90deg);
    -webkit-animation-timing-function: ease-in;
    animation-timing-function: ease-in;
    opacity: 0;
  }

  40% {
    -webkit-transform: perspective(400px) rotate3d(1, 0, 0, -20deg);
    transform: perspective(400px) rotate3d(1, 0, 0, -20deg);
    -webkit-animation-timing-function: ease-in;
    animation-timing-function: ease-in;
  }

  60% {
    -webkit-transform: perspective(400px) rotate3d(1, 0, 0, 10deg);
    transform: perspective(400px) rotate3d(1, 0, 0, 10deg);
    opacity: 1;
  }

  80% {
    -webkit-transform: perspective(400px) rotate3d(1, 0, 0, -5deg);
    transform: perspective(400px) rotate3d(1, 0, 0, -5deg);
  }

  to {
    -webkit-transform: perspective(400px);
    transform: perspective(400px);
  }
}
@keyframes flipInX {
  from {
    -webkit-transform: perspective(400px) rotate3d(1, 0, 0, 90deg);
    transform: perspective(400px) rotate3d(1, 0, 0, 90deg);
    -webkit-animation-timing-function: ease-in;
    animation-timing-function: ease-in;
    opacity: 0;
  }

  40% {
    -webkit-transform: perspective(400px) rotate3d(1, 0, 0, -20deg);
    transform: perspective(400px) rotate3d(1, 0, 0, -20deg);
    -webkit-animation-timing-function: ease-in;
    animation-timing-function: ease-in;
  }

  60% {
    -webkit-transform: perspective(400px) rotate3d(1, 0, 0, 10deg);
    transform: perspective(400px) rotate3d(1, 0, 0, 10deg);
    opacity: 1;
  }

  80% {
    -webkit-transform: perspective(400px) rotate3d(1, 0, 0, -5deg);
    transform: perspective(400px) rotate3d(1, 0, 0, -5deg);
  }

  to {
    -webkit-transform: perspective(400px);
    transform: perspective(400px);
  }
}
.animate__flipInX {
  -webkit-backface-visibility: visible !important;
  backface-visibility: visible !important;
  -webkit-animation-name: flipInX;
  animation-name: flipInX;
}
@-webkit-keyframes flipInY {
  from {
    -webkit-transform: perspective(400px) rotate3d(0, 1, 0, 90deg);
    transform: perspective(400px) rotate3d(0, 1, 0, 90deg);
    -webkit-animation-timing-function: ease-in;
    animation-timing-function: ease-in;
    opacity: 0;
  }

  40% {
    -webkit-transform: perspective(400px) rotate3d(0, 1, 0, -20deg);
    transform: perspective(400px) rotate3d(0, 1, 0, -20deg);
    -webkit-animation-timing-function: ease-in;
    animation-timing-function: ease-in;
  }

  60% {
    -webkit-transform: perspective(400px) rotate3d(0, 1, 0, 10deg);
    transform: perspective(400px) rotate3d(0, 1, 0, 10deg);
    opacity: 1;
  }

  80% {
    -webkit-transform: perspective(400px) rotate3d(0, 1, 0, -5deg);
    transform: perspective(400px) rotate3d(0, 1, 0, -5deg);
  }

  to {
    -webkit-transform: perspective(400px);
    transform: perspective(400px);
  }
}
@keyframes flipInY {
  from {
    -webkit-transform: perspective(400px) rotate3d(0, 1, 0, 90deg);
    transform: perspective(400px) rotate3d(0, 1, 0, 90deg);
    -webkit-animation-timing-function: ease-in;
    animation-timing-function: ease-in;
    opacity: 0;
  }

  40% {
    -webkit-transform: perspective(400px) rotate3d(0, 1, 0, -20deg);
    transform: perspective(400px) rotate3d(0, 1, 0, -20deg);
    -webkit-animation-timing-function: ease-in;
    animation-timing-function: ease-in;
  }

  60% {
    -webkit-transform: perspective(400px) rotate3d(0, 1, 0, 10deg);
    transform: perspective(400px) rotate3d(0, 1, 0, 10deg);
    opacity: 1;
  }

  80% {
    -webkit-transform: perspective(400px) rotate3d(0, 1, 0, -5deg);
    transform: perspective(400px) rotate3d(0, 1, 0, -5deg);
  }

  to {
    -webkit-transform: perspective(400px);
    transform: perspective(400px);
  }
}
.animate__flipInY {
  -webkit-backface-visibility: visible !important;
  backface-visibility: visible !important;
  -webkit-animation-name: flipInY;
  animation-name: flipInY;
}
@-webkit-keyframes flipOutX {
  from {
    -webkit-transform: perspective(400px);
    transform: perspective(400px);
  }

  30% {
    -webkit-transform: perspective(400px) rotate3d(1, 0, 0, -20deg);
    transform: perspective(400px) rotate3d(1, 0, 0, -20deg);
    opacity: 1;
  }

  to {
    -webkit-transform: perspective(400px) rotate3d(1, 0, 0, 90deg);
    transform: perspective(400px) rotate3d(1, 0, 0, 90deg);
    opacity: 0;
  }
}
@keyframes flipOutX {
  from {
    -webkit-transform: perspective(400px);
    transform: perspective(400px);
  }

  30% {
    -webkit-transform: perspective(400px) rotate3d(1, 0, 0, -20deg);
    transform: perspective(400px) rotate3d(1, 0, 0, -20deg);
    opacity: 1;
  }

  to {
    -webkit-transform: perspective(400px) rotate3d(1, 0, 0, 90deg);
    transform: perspective(400px) rotate3d(1, 0, 0, 90deg);
    opacity: 0;
  }
}
.animate__flipOutX {
  -webkit-animation-duration: calc(1s * 0.75);
  animation-duration: calc(1s * 0.75);
  -webkit-animation-duration: calc(var(--animate-duration) * 0.75);
  animation-duration: calc(var(--animate-duration) * 0.75);
  -webkit-animation-name: flipOutX;
  animation-name: flipOutX;
  -webkit-backface-visibility: visible !important;
  backface-visibility: visible !important;
}
@-webkit-keyframes flipOutY {
  from {
    -webkit-transform: perspective(400px);
    transform: perspective(400px);
  }

  30% {
    -webkit-transform: perspective(400px) rotate3d(0, 1, 0, -15deg);
    transform: perspective(400px) rotate3d(0, 1, 0, -15deg);
    opacity: 1;
  }

  to {
    -webkit-transform: perspective(400px) rotate3d(0, 1, 0, 90deg);
    transform: perspective(400px) rotate3d(0, 1, 0, 90deg);
    opacity: 0;
  }
}
@keyframes flipOutY {
  from {
    -webkit-transform: perspective(400px);
    transform: perspective(400px);
  }

  30% {
    -webkit-transform: perspective(400px) rotate3d(0, 1, 0, -15deg);
    transform: perspective(400px) rotate3d(0, 1, 0, -15deg);
    opacity: 1;
  }

  to {
    -webkit-transform: perspective(400px) rotate3d(0, 1, 0, 90deg);
    transform: perspective(400px) rotate3d(0, 1, 0, 90deg);
    opacity: 0;
  }
}
.animate__flipOutY {
  -webkit-animation-duration: calc(1s * 0.75);
  animation-duration: calc(1s * 0.75);
  -webkit-animation-duration: calc(var(--animate-duration) * 0.75);
  animation-duration: calc(var(--animate-duration) * 0.75);
  -webkit-backface-visibility: visible !important;
  backface-visibility: visible !important;
  -webkit-animation-name: flipOutY;
  animation-name: flipOutY;
}
/* Lightspeed */
@-webkit-keyframes lightSpeedInRight {
  from {
    -webkit-transform: translate3d(100%, 0, 0) skewX(-30deg);
    transform: translate3d(100%, 0, 0) skewX(-30deg);
    opacity: 0;
  }

  60% {
    -webkit-transform: skewX(20deg);
    transform: skewX(20deg);
    opacity: 1;
  }

  80% {
    -webkit-transform: skewX(-5deg);
    transform: skewX(-5deg);
  }

  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
@keyframes lightSpeedInRight {
  from {
    -webkit-transform: translate3d(100%, 0, 0) skewX(-30deg);
    transform: translate3d(100%, 0, 0) skewX(-30deg);
    opacity: 0;
  }

  60% {
    -webkit-transform: skewX(20deg);
    transform: skewX(20deg);
    opacity: 1;
  }

  80% {
    -webkit-transform: skewX(-5deg);
    transform: skewX(-5deg);
  }

  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
.animate__lightSpeedInRight {
  -webkit-animation-name: lightSpeedInRight;
  animation-name: lightSpeedInRight;
  -webkit-animation-timing-function: ease-out;
  animation-timing-function: ease-out;
}
@-webkit-keyframes lightSpeedInLeft {
  from {
    -webkit-transform: translate3d(-100%, 0, 0) skewX(30deg);
    transform: translate3d(-100%, 0, 0) skewX(30deg);
    opacity: 0;
  }

  60% {
    -webkit-transform: skewX(-20deg);
    transform: skewX(-20deg);
    opacity: 1;
  }

  80% {
    -webkit-transform: skewX(5deg);
    transform: skewX(5deg);
  }

  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
@keyframes lightSpeedInLeft {
  from {
    -webkit-transform: translate3d(-100%, 0, 0) skewX(30deg);
    transform: translate3d(-100%, 0, 0) skewX(30deg);
    opacity: 0;
  }

  60% {
    -webkit-transform: skewX(-20deg);
    transform: skewX(-20deg);
    opacity: 1;
  }

  80% {
    -webkit-transform: skewX(5deg);
    transform: skewX(5deg);
  }

  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
.animate__lightSpeedInLeft {
  -webkit-animation-name: lightSpeedInLeft;
  animation-name: lightSpeedInLeft;
  -webkit-animation-timing-function: ease-out;
  animation-timing-function: ease-out;
}
@-webkit-keyframes lightSpeedOutRight {
  from {
    opacity: 1;
  }

  to {
    -webkit-transform: translate3d(100%, 0, 0) skewX(30deg);
    transform: translate3d(100%, 0, 0) skewX(30deg);
    opacity: 0;
  }
}
@keyframes lightSpeedOutRight {
  from {
    opacity: 1;
  }

  to {
    -webkit-transform: translate3d(100%, 0, 0) skewX(30deg);
    transform: translate3d(100%, 0, 0) skewX(30deg);
    opacity: 0;
  }
}
.animate__lightSpeedOutRight {
  -webkit-animation-name: lightSpeedOutRight;
  animation-name: lightSpeedOutRight;
  -webkit-animation-timing-function: ease-in;
  animation-timing-function: ease-in;
}
@-webkit-keyframes lightSpeedOutLeft {
  from {
    opacity: 1;
  }

  to {
    -webkit-transform: translate3d(-100%, 0, 0) skewX(-30deg);
    transform: translate3d(-100%, 0, 0) skewX(-30deg);
    opacity: 0;
  }
}
@keyframes lightSpeedOutLeft {
  from {
    opacity: 1;
  }

  to {
    -webkit-transform: translate3d(-100%, 0, 0) skewX(-30deg);
    transform: translate3d(-100%, 0, 0) skewX(-30deg);
    opacity: 0;
  }
}
.animate__lightSpeedOutLeft {
  -webkit-animation-name: lightSpeedOutLeft;
  animation-name: lightSpeedOutLeft;
  -webkit-animation-timing-function: ease-in;
  animation-timing-function: ease-in;
}
/* Rotating entrances */
@-webkit-keyframes rotateIn {
  from {
    -webkit-transform: rotate3d(0, 0, 1, -200deg);
    transform: rotate3d(0, 0, 1, -200deg);
    opacity: 0;
  }

  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
    opacity: 1;
  }
}
@keyframes rotateIn {
  from {
    -webkit-transform: rotate3d(0, 0, 1, -200deg);
    transform: rotate3d(0, 0, 1, -200deg);
    opacity: 0;
  }

  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
    opacity: 1;
  }
}
.animate__rotateIn {
  -webkit-animation-name: rotateIn;
  animation-name: rotateIn;
  -webkit-transform-origin: center;
  transform-origin: center;
}
@-webkit-keyframes rotateInDownLeft {
  from {
    -webkit-transform: rotate3d(0, 0, 1, -45deg);
    transform: rotate3d(0, 0, 1, -45deg);
    opacity: 0;
  }

  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
    opacity: 1;
  }
}
@keyframes rotateInDownLeft {
  from {
    -webkit-transform: rotate3d(0, 0, 1, -45deg);
    transform: rotate3d(0, 0, 1, -45deg);
    opacity: 0;
  }

  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
    opacity: 1;
  }
}
.animate__rotateInDownLeft {
  -webkit-animation-name: rotateInDownLeft;
  animation-name: rotateInDownLeft;
  -webkit-transform-origin: left bottom;
  transform-origin: left bottom;
}
@-webkit-keyframes rotateInDownRight {
  from {
    -webkit-transform: rotate3d(0, 0, 1, 45deg);
    transform: rotate3d(0, 0, 1, 45deg);
    opacity: 0;
  }

  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
    opacity: 1;
  }
}
@keyframes rotateInDownRight {
  from {
    -webkit-transform: rotate3d(0, 0, 1, 45deg);
    transform: rotate3d(0, 0, 1, 45deg);
    opacity: 0;
  }

  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
    opacity: 1;
  }
}
.animate__rotateInDownRight {
  -webkit-animation-name: rotateInDownRight;
  animation-name: rotateInDownRight;
  -webkit-transform-origin: right bottom;
  transform-origin: right bottom;
}
@-webkit-keyframes rotateInUpLeft {
  from {
    -webkit-transform: rotate3d(0, 0, 1, 45deg);
    transform: rotate3d(0, 0, 1, 45deg);
    opacity: 0;
  }

  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
    opacity: 1;
  }
}
@keyframes rotateInUpLeft {
  from {
    -webkit-transform: rotate3d(0, 0, 1, 45deg);
    transform: rotate3d(0, 0, 1, 45deg);
    opacity: 0;
  }

  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
    opacity: 1;
  }
}
.animate__rotateInUpLeft {
  -webkit-animation-name: rotateInUpLeft;
  animation-name: rotateInUpLeft;
  -webkit-transform-origin: left bottom;
  transform-origin: left bottom;
}
@-webkit-keyframes rotateInUpRight {
  from {
    -webkit-transform: rotate3d(0, 0, 1, -90deg);
    transform: rotate3d(0, 0, 1, -90deg);
    opacity: 0;
  }

  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
    opacity: 1;
  }
}
@keyframes rotateInUpRight {
  from {
    -webkit-transform: rotate3d(0, 0, 1, -90deg);
    transform: rotate3d(0, 0, 1, -90deg);
    opacity: 0;
  }

  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
    opacity: 1;
  }
}
.animate__rotateInUpRight {
  -webkit-animation-name: rotateInUpRight;
  animation-name: rotateInUpRight;
  -webkit-transform-origin: right bottom;
  transform-origin: right bottom;
}
/* Rotating exits */
@-webkit-keyframes rotateOut {
  from {
    opacity: 1;
  }

  to {
    -webkit-transform: rotate3d(0, 0, 1, 200deg);
    transform: rotate3d(0, 0, 1, 200deg);
    opacity: 0;
  }
}
@keyframes rotateOut {
  from {
    opacity: 1;
  }

  to {
    -webkit-transform: rotate3d(0, 0, 1, 200deg);
    transform: rotate3d(0, 0, 1, 200deg);
    opacity: 0;
  }
}
.animate__rotateOut {
  -webkit-animation-name: rotateOut;
  animation-name: rotateOut;
  -webkit-transform-origin: center;
  transform-origin: center;
}
@-webkit-keyframes rotateOutDownLeft {
  from {
    opacity: 1;
  }

  to {
    -webkit-transform: rotate3d(0, 0, 1, 45deg);
    transform: rotate3d(0, 0, 1, 45deg);
    opacity: 0;
  }
}
@keyframes rotateOutDownLeft {
  from {
    opacity: 1;
  }

  to {
    -webkit-transform: rotate3d(0, 0, 1, 45deg);
    transform: rotate3d(0, 0, 1, 45deg);
    opacity: 0;
  }
}
.animate__rotateOutDownLeft {
  -webkit-animation-name: rotateOutDownLeft;
  animation-name: rotateOutDownLeft;
  -webkit-transform-origin: left bottom;
  transform-origin: left bottom;
}
@-webkit-keyframes rotateOutDownRight {
  from {
    opacity: 1;
  }

  to {
    -webkit-transform: rotate3d(0, 0, 1, -45deg);
    transform: rotate3d(0, 0, 1, -45deg);
    opacity: 0;
  }
}
@keyframes rotateOutDownRight {
  from {
    opacity: 1;
  }

  to {
    -webkit-transform: rotate3d(0, 0, 1, -45deg);
    transform: rotate3d(0, 0, 1, -45deg);
    opacity: 0;
  }
}
.animate__rotateOutDownRight {
  -webkit-animation-name: rotateOutDownRight;
  animation-name: rotateOutDownRight;
  -webkit-transform-origin: right bottom;
  transform-origin: right bottom;
}
@-webkit-keyframes rotateOutUpLeft {
  from {
    opacity: 1;
  }

  to {
    -webkit-transform: rotate3d(0, 0, 1, -45deg);
    transform: rotate3d(0, 0, 1, -45deg);
    opacity: 0;
  }
}
@keyframes rotateOutUpLeft {
  from {
    opacity: 1;
  }

  to {
    -webkit-transform: rotate3d(0, 0, 1, -45deg);
    transform: rotate3d(0, 0, 1, -45deg);
    opacity: 0;
  }
}
.animate__rotateOutUpLeft {
  -webkit-animation-name: rotateOutUpLeft;
  animation-name: rotateOutUpLeft;
  -webkit-transform-origin: left bottom;
  transform-origin: left bottom;
}
@-webkit-keyframes rotateOutUpRight {
  from {
    opacity: 1;
  }

  to {
    -webkit-transform: rotate3d(0, 0, 1, 90deg);
    transform: rotate3d(0, 0, 1, 90deg);
    opacity: 0;
  }
}
@keyframes rotateOutUpRight {
  from {
    opacity: 1;
  }

  to {
    -webkit-transform: rotate3d(0, 0, 1, 90deg);
    transform: rotate3d(0, 0, 1, 90deg);
    opacity: 0;
  }
}
.animate__rotateOutUpRight {
  -webkit-animation-name: rotateOutUpRight;
  animation-name: rotateOutUpRight;
  -webkit-transform-origin: right bottom;
  transform-origin: right bottom;
}
/* Specials */
@-webkit-keyframes hinge {
  0% {
    -webkit-animation-timing-function: ease-in-out;
    animation-timing-function: ease-in-out;
  }

  20%,
  60% {
    -webkit-transform: rotate3d(0, 0, 1, 80deg);
    transform: rotate3d(0, 0, 1, 80deg);
    -webkit-animation-timing-function: ease-in-out;
    animation-timing-function: ease-in-out;
  }

  40%,
  80% {
    -webkit-transform: rotate3d(0, 0, 1, 60deg);
    transform: rotate3d(0, 0, 1, 60deg);
    -webkit-animation-timing-function: ease-in-out;
    animation-timing-function: ease-in-out;
    opacity: 1;
  }

  to {
    -webkit-transform: translate3d(0, 700px, 0);
    transform: translate3d(0, 700px, 0);
    opacity: 0;
  }
}
@keyframes hinge {
  0% {
    -webkit-animation-timing-function: ease-in-out;
    animation-timing-function: ease-in-out;
  }

  20%,
  60% {
    -webkit-transform: rotate3d(0, 0, 1, 80deg);
    transform: rotate3d(0, 0, 1, 80deg);
    -webkit-animation-timing-function: ease-in-out;
    animation-timing-function: ease-in-out;
  }

  40%,
  80% {
    -webkit-transform: rotate3d(0, 0, 1, 60deg);
    transform: rotate3d(0, 0, 1, 60deg);
    -webkit-animation-timing-function: ease-in-out;
    animation-timing-function: ease-in-out;
    opacity: 1;
  }

  to {
    -webkit-transform: translate3d(0, 700px, 0);
    transform: translate3d(0, 700px, 0);
    opacity: 0;
  }
}
.animate__hinge {
  -webkit-animation-duration: calc(1s * 2);
  animation-duration: calc(1s * 2);
  -webkit-animation-duration: calc(var(--animate-duration) * 2);
  animation-duration: calc(var(--animate-duration) * 2);
  -webkit-animation-name: hinge;
  animation-name: hinge;
  -webkit-transform-origin: top left;
  transform-origin: top left;
}
@-webkit-keyframes jackInTheBox {
  from {
    opacity: 0;
    -webkit-transform: scale(0.1) rotate(30deg);
    transform: scale(0.1) rotate(30deg);
    -webkit-transform-origin: center bottom;
    transform-origin: center bottom;
  }

  50% {
    -webkit-transform: rotate(-10deg);
    transform: rotate(-10deg);
  }

  70% {
    -webkit-transform: rotate(3deg);
    transform: rotate(3deg);
  }

  to {
    opacity: 1;
    -webkit-transform: scale(1);
    transform: scale(1);
  }
}
@keyframes jackInTheBox {
  from {
    opacity: 0;
    -webkit-transform: scale(0.1) rotate(30deg);
    transform: scale(0.1) rotate(30deg);
    -webkit-transform-origin: center bottom;
    transform-origin: center bottom;
  }

  50% {
    -webkit-transform: rotate(-10deg);
    transform: rotate(-10deg);
  }

  70% {
    -webkit-transform: rotate(3deg);
    transform: rotate(3deg);
  }

  to {
    opacity: 1;
    -webkit-transform: scale(1);
    transform: scale(1);
  }
}
.animate__jackInTheBox {
  -webkit-animation-name: jackInTheBox;
  animation-name: jackInTheBox;
}
/* originally authored by Nick Pettit - https://github.com/nickpettit/glide */
@-webkit-keyframes rollIn {
  from {
    opacity: 0;
    -webkit-transform: translate3d(-100%, 0, 0) rotate3d(0, 0, 1, -120deg);
    transform: translate3d(-100%, 0, 0) rotate3d(0, 0, 1, -120deg);
  }

  to {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
@keyframes rollIn {
  from {
    opacity: 0;
    -webkit-transform: translate3d(-100%, 0, 0) rotate3d(0, 0, 1, -120deg);
    transform: translate3d(-100%, 0, 0) rotate3d(0, 0, 1, -120deg);
  }

  to {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
.animate__rollIn {
  -webkit-animation-name: rollIn;
  animation-name: rollIn;
}
/* originally authored by Nick Pettit - https://github.com/nickpettit/glide */
@-webkit-keyframes rollOut {
  from {
    opacity: 1;
  }

  to {
    opacity: 0;
    -webkit-transform: translate3d(100%, 0, 0) rotate3d(0, 0, 1, 120deg);
    transform: translate3d(100%, 0, 0) rotate3d(0, 0, 1, 120deg);
  }
}
@keyframes rollOut {
  from {
    opacity: 1;
  }

  to {
    opacity: 0;
    -webkit-transform: translate3d(100%, 0, 0) rotate3d(0, 0, 1, 120deg);
    transform: translate3d(100%, 0, 0) rotate3d(0, 0, 1, 120deg);
  }
}
.animate__rollOut {
  -webkit-animation-name: rollOut;
  animation-name: rollOut;
}
/* Zooming entrances */
@-webkit-keyframes zoomIn {
  from {
    opacity: 0;
    -webkit-transform: scale3d(0.3, 0.3, 0.3);
    transform: scale3d(0.3, 0.3, 0.3);
  }

  50% {
    opacity: 1;
  }
}
@keyframes zoomIn {
  from {
    opacity: 0;
    -webkit-transform: scale3d(0.3, 0.3, 0.3);
    transform: scale3d(0.3, 0.3, 0.3);
  }

  50% {
    opacity: 1;
  }
}
.animate__zoomIn {
  -webkit-animation-name: zoomIn;
  animation-name: zoomIn;
}
@-webkit-keyframes zoomInDown {
  from {
    opacity: 0;
    -webkit-transform: scale3d(0.1, 0.1, 0.1) translate3d(0, -1000px, 0);
    transform: scale3d(0.1, 0.1, 0.1) translate3d(0, -1000px, 0);
    -webkit-animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
    animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
  }

  60% {
    opacity: 1;
    -webkit-transform: scale3d(0.475, 0.475, 0.475) translate3d(0, 60px, 0);
    transform: scale3d(0.475, 0.475, 0.475) translate3d(0, 60px, 0);
    -webkit-animation-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1);
    animation-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1);
  }
}
@keyframes zoomInDown {
  from {
    opacity: 0;
    -webkit-transform: scale3d(0.1, 0.1, 0.1) translate3d(0, -1000px, 0);
    transform: scale3d(0.1, 0.1, 0.1) translate3d(0, -1000px, 0);
    -webkit-animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
    animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
  }

  60% {
    opacity: 1;
    -webkit-transform: scale3d(0.475, 0.475, 0.475) translate3d(0, 60px, 0);
    transform: scale3d(0.475, 0.475, 0.475) translate3d(0, 60px, 0);
    -webkit-animation-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1);
    animation-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1);
  }
}
.animate__zoomInDown {
  -webkit-animation-name: zoomInDown;
  animation-name: zoomInDown;
}
@-webkit-keyframes zoomInLeft {
  from {
    opacity: 0;
    -webkit-transform: scale3d(0.1, 0.1, 0.1) translate3d(-1000px, 0, 0);
    transform: scale3d(0.1, 0.1, 0.1) translate3d(-1000px, 0, 0);
    -webkit-animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
    animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
  }

  60% {
    opacity: 1;
    -webkit-transform: scale3d(0.475, 0.475, 0.475) translate3d(10px, 0, 0);
    transform: scale3d(0.475, 0.475, 0.475) translate3d(10px, 0, 0);
    -webkit-animation-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1);
    animation-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1);
  }
}
@keyframes zoomInLeft {
  from {
    opacity: 0;
    -webkit-transform: scale3d(0.1, 0.1, 0.1) translate3d(-1000px, 0, 0);
    transform: scale3d(0.1, 0.1, 0.1) translate3d(-1000px, 0, 0);
    -webkit-animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
    animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
  }

  60% {
    opacity: 1;
    -webkit-transform: scale3d(0.475, 0.475, 0.475) translate3d(10px, 0, 0);
    transform: scale3d(0.475, 0.475, 0.475) translate3d(10px, 0, 0);
    -webkit-animation-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1);
    animation-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1);
  }
}
.animate__zoomInLeft {
  -webkit-animation-name: zoomInLeft;
  animation-name: zoomInLeft;
}
@-webkit-keyframes zoomInRight {
  from {
    opacity: 0;
    -webkit-transform: scale3d(0.1, 0.1, 0.1) translate3d(1000px, 0, 0);
    transform: scale3d(0.1, 0.1, 0.1) translate3d(1000px, 0, 0);
    -webkit-animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
    animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
  }

  60% {
    opacity: 1;
    -webkit-transform: scale3d(0.475, 0.475, 0.475) translate3d(-10px, 0, 0);
    transform: scale3d(0.475, 0.475, 0.475) translate3d(-10px, 0, 0);
    -webkit-animation-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1);
    animation-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1);
  }
}
@keyframes zoomInRight {
  from {
    opacity: 0;
    -webkit-transform: scale3d(0.1, 0.1, 0.1) translate3d(1000px, 0, 0);
    transform: scale3d(0.1, 0.1, 0.1) translate3d(1000px, 0, 0);
    -webkit-animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
    animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
  }

  60% {
    opacity: 1;
    -webkit-transform: scale3d(0.475, 0.475, 0.475) translate3d(-10px, 0, 0);
    transform: scale3d(0.475, 0.475, 0.475) translate3d(-10px, 0, 0);
    -webkit-animation-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1);
    animation-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1);
  }
}
.animate__zoomInRight {
  -webkit-animation-name: zoomInRight;
  animation-name: zoomInRight;
}
@-webkit-keyframes zoomInUp {
  from {
    opacity: 0;
    -webkit-transform: scale3d(0.1, 0.1, 0.1) translate3d(0, 1000px, 0);
    transform: scale3d(0.1, 0.1, 0.1) translate3d(0, 1000px, 0);
    -webkit-animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
    animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
  }

  60% {
    opacity: 1;
    -webkit-transform: scale3d(0.475, 0.475, 0.475) translate3d(0, -60px, 0);
    transform: scale3d(0.475, 0.475, 0.475) translate3d(0, -60px, 0);
    -webkit-animation-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1);
    animation-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1);
  }
}
@keyframes zoomInUp {
  from {
    opacity: 0;
    -webkit-transform: scale3d(0.1, 0.1, 0.1) translate3d(0, 1000px, 0);
    transform: scale3d(0.1, 0.1, 0.1) translate3d(0, 1000px, 0);
    -webkit-animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
    animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
  }

  60% {
    opacity: 1;
    -webkit-transform: scale3d(0.475, 0.475, 0.475) translate3d(0, -60px, 0);
    transform: scale3d(0.475, 0.475, 0.475) translate3d(0, -60px, 0);
    -webkit-animation-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1);
    animation-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1);
  }
}
.animate__zoomInUp {
  -webkit-animation-name: zoomInUp;
  animation-name: zoomInUp;
}
/* Zooming exits */
@-webkit-keyframes zoomOut {
  from {
    opacity: 1;
  }

  50% {
    opacity: 0;
    -webkit-transform: scale3d(0.3, 0.3, 0.3);
    transform: scale3d(0.3, 0.3, 0.3);
  }

  to {
    opacity: 0;
  }
}
@keyframes zoomOut {
  from {
    opacity: 1;
  }

  50% {
    opacity: 0;
    -webkit-transform: scale3d(0.3, 0.3, 0.3);
    transform: scale3d(0.3, 0.3, 0.3);
  }

  to {
    opacity: 0;
  }
}
.animate__zoomOut {
  -webkit-animation-name: zoomOut;
  animation-name: zoomOut;
}
@-webkit-keyframes zoomOutDown {
  40% {
    opacity: 1;
    -webkit-transform: scale3d(0.475, 0.475, 0.475) translate3d(0, -60px, 0);
    transform: scale3d(0.475, 0.475, 0.475) translate3d(0, -60px, 0);
    -webkit-animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
    animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
  }

  to {
    opacity: 0;
    -webkit-transform: scale3d(0.1, 0.1, 0.1) translate3d(0, 2000px, 0);
    transform: scale3d(0.1, 0.1, 0.1) translate3d(0, 2000px, 0);
    -webkit-animation-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1);
    animation-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1);
  }
}
@keyframes zoomOutDown {
  40% {
    opacity: 1;
    -webkit-transform: scale3d(0.475, 0.475, 0.475) translate3d(0, -60px, 0);
    transform: scale3d(0.475, 0.475, 0.475) translate3d(0, -60px, 0);
    -webkit-animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
    animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
  }

  to {
    opacity: 0;
    -webkit-transform: scale3d(0.1, 0.1, 0.1) translate3d(0, 2000px, 0);
    transform: scale3d(0.1, 0.1, 0.1) translate3d(0, 2000px, 0);
    -webkit-animation-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1);
    animation-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1);
  }
}
.animate__zoomOutDown {
  -webkit-animation-name: zoomOutDown;
  animation-name: zoomOutDown;
  -webkit-transform-origin: center bottom;
  transform-origin: center bottom;
}
@-webkit-keyframes zoomOutLeft {
  40% {
    opacity: 1;
    -webkit-transform: scale3d(0.475, 0.475, 0.475) translate3d(42px, 0, 0);
    transform: scale3d(0.475, 0.475, 0.475) translate3d(42px, 0, 0);
  }

  to {
    opacity: 0;
    -webkit-transform: scale(0.1) translate3d(-2000px, 0, 0);
    transform: scale(0.1) translate3d(-2000px, 0, 0);
  }
}
@keyframes zoomOutLeft {
  40% {
    opacity: 1;
    -webkit-transform: scale3d(0.475, 0.475, 0.475) translate3d(42px, 0, 0);
    transform: scale3d(0.475, 0.475, 0.475) translate3d(42px, 0, 0);
  }

  to {
    opacity: 0;
    -webkit-transform: scale(0.1) translate3d(-2000px, 0, 0);
    transform: scale(0.1) translate3d(-2000px, 0, 0);
  }
}
.animate__zoomOutLeft {
  -webkit-animation-name: zoomOutLeft;
  animation-name: zoomOutLeft;
  -webkit-transform-origin: left center;
  transform-origin: left center;
}
@-webkit-keyframes zoomOutRight {
  40% {
    opacity: 1;
    -webkit-transform: scale3d(0.475, 0.475, 0.475) translate3d(-42px, 0, 0);
    transform: scale3d(0.475, 0.475, 0.475) translate3d(-42px, 0, 0);
  }

  to {
    opacity: 0;
    -webkit-transform: scale(0.1) translate3d(2000px, 0, 0);
    transform: scale(0.1) translate3d(2000px, 0, 0);
  }
}
@keyframes zoomOutRight {
  40% {
    opacity: 1;
    -webkit-transform: scale3d(0.475, 0.475, 0.475) translate3d(-42px, 0, 0);
    transform: scale3d(0.475, 0.475, 0.475) translate3d(-42px, 0, 0);
  }

  to {
    opacity: 0;
    -webkit-transform: scale(0.1) translate3d(2000px, 0, 0);
    transform: scale(0.1) translate3d(2000px, 0, 0);
  }
}
.animate__zoomOutRight {
  -webkit-animation-name: zoomOutRight;
  animation-name: zoomOutRight;
  -webkit-transform-origin: right center;
  transform-origin: right center;
}
@-webkit-keyframes zoomOutUp {
  40% {
    opacity: 1;
    -webkit-transform: scale3d(0.475, 0.475, 0.475) translate3d(0, 60px, 0);
    transform: scale3d(0.475, 0.475, 0.475) translate3d(0, 60px, 0);
    -webkit-animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
    animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
  }

  to {
    opacity: 0;
    -webkit-transform: scale3d(0.1, 0.1, 0.1) translate3d(0, -2000px, 0);
    transform: scale3d(0.1, 0.1, 0.1) translate3d(0, -2000px, 0);
    -webkit-animation-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1);
    animation-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1);
  }
}
@keyframes zoomOutUp {
  40% {
    opacity: 1;
    -webkit-transform: scale3d(0.475, 0.475, 0.475) translate3d(0, 60px, 0);
    transform: scale3d(0.475, 0.475, 0.475) translate3d(0, 60px, 0);
    -webkit-animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
    animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
  }

  to {
    opacity: 0;
    -webkit-transform: scale3d(0.1, 0.1, 0.1) translate3d(0, -2000px, 0);
    transform: scale3d(0.1, 0.1, 0.1) translate3d(0, -2000px, 0);
    -webkit-animation-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1);
    animation-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1);
  }
}
.animate__zoomOutUp {
  -webkit-animation-name: zoomOutUp;
  animation-name: zoomOutUp;
  -webkit-transform-origin: center bottom;
  transform-origin: center bottom;
}
/* Sliding entrances */
@-webkit-keyframes slideInDown {
  from {
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
    visibility: visible;
  }

  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
@keyframes slideInDown {
  from {
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
    visibility: visible;
  }

  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
.animate__slideInDown {
  -webkit-animation-name: slideInDown;
  animation-name: slideInDown;
}
@-webkit-keyframes slideInLeft {
  from {
    -webkit-transform: translate3d(-100%, 0, 0);
    transform: translate3d(-100%, 0, 0);
    visibility: visible;
  }

  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
@keyframes slideInLeft {
  from {
    -webkit-transform: translate3d(-100%, 0, 0);
    transform: translate3d(-100%, 0, 0);
    visibility: visible;
  }

  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
.animate__slideInLeft {
  -webkit-animation-name: slideInLeft;
  animation-name: slideInLeft;
}
@-webkit-keyframes slideInRight {
  from {
    -webkit-transform: translate3d(100%, 0, 0);
    transform: translate3d(100%, 0, 0);
    visibility: visible;
  }

  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
@keyframes slideInRight {
  from {
    -webkit-transform: translate3d(100%, 0, 0);
    transform: translate3d(100%, 0, 0);
    visibility: visible;
  }

  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
.animate__slideInRight {
  -webkit-animation-name: slideInRight;
  animation-name: slideInRight;
}
@-webkit-keyframes slideInUp {
  from {
    -webkit-transform: translate3d(0, 100%, 0);
    transform: translate3d(0, 100%, 0);
    visibility: visible;
  }

  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
@keyframes slideInUp {
  from {
    -webkit-transform: translate3d(0, 100%, 0);
    transform: translate3d(0, 100%, 0);
    visibility: visible;
  }

  to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
.animate__slideInUp {
  -webkit-animation-name: slideInUp;
  animation-name: slideInUp;
}
/* Sliding exits */
@-webkit-keyframes slideOutDown {
  from {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }

  to {
    visibility: hidden;
    -webkit-transform: translate3d(0, 100%, 0);
    transform: translate3d(0, 100%, 0);
  }
}
@keyframes slideOutDown {
  from {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }

  to {
    visibility: hidden;
    -webkit-transform: translate3d(0, 100%, 0);
    transform: translate3d(0, 100%, 0);
  }
}
.animate__slideOutDown {
  -webkit-animation-name: slideOutDown;
  animation-name: slideOutDown;
}
@-webkit-keyframes slideOutLeft {
  from {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }

  to {
    visibility: hidden;
    -webkit-transform: translate3d(-100%, 0, 0);
    transform: translate3d(-100%, 0, 0);
  }
}
@keyframes slideOutLeft {
  from {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }

  to {
    visibility: hidden;
    -webkit-transform: translate3d(-100%, 0, 0);
    transform: translate3d(-100%, 0, 0);
  }
}
.animate__slideOutLeft {
  -webkit-animation-name: slideOutLeft;
  animation-name: slideOutLeft;
}
@-webkit-keyframes slideOutRight {
  from {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }

  to {
    visibility: hidden;
    -webkit-transform: translate3d(100%, 0, 0);
    transform: translate3d(100%, 0, 0);
  }
}
@keyframes slideOutRight {
  from {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }

  to {
    visibility: hidden;
    -webkit-transform: translate3d(100%, 0, 0);
    transform: translate3d(100%, 0, 0);
  }
}
.animate__slideOutRight {
  -webkit-animation-name: slideOutRight;
  animation-name: slideOutRight;
}
@-webkit-keyframes slideOutUp {
  from {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }

  to {
    visibility: hidden;
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
  }
}
@keyframes slideOutUp {
  from {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }

  to {
    visibility: hidden;
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
  }
}
.animate__slideOutUp {
  -webkit-animation-name: slideOutUp;
  animation-name: slideOutUp;
}

@font-face {
  font-family: 'lg';
  src: url(/fonts/vendor/lightgallery/lg.woff2?64b800aa30714fd916dce5018ba7ad76) format("woff2"), url(/fonts/vendor/lightgallery/lg.ttf?747d038541bfc6bb8ea9118bed9c160e) format("truetype"), url(/fonts/vendor/lightgallery/lg.woff?356a0e9cb064c7a196c612ebf7523686) format("woff"), url(/fonts/vendor/lightgallery/lg.svg?09cd8e9be7081f2166444cce393fe968#lg) format("svg");
  font-weight: normal;
  font-style: normal;
  font-display: block;
}

.lg-icon {
  /* use !important to prevent issues with browser extensions that change fonts */
  font-family: 'lg' !important;
  speak: never;
  font-style: normal;
  font-weight: normal;
  font-variant: normal;
  text-transform: none;
  line-height: 1;
  /* Better Font Rendering =========== */
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

.lg-container {
  font-family: system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', 'Liberation Sans', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
}

.lg-next,
.lg-prev {
  background-color: rgba(0, 0, 0, 0.45);
  border-radius: 2px;
  color: #999;
  cursor: pointer;
  display: block;
  font-size: 22px;
  margin-top: -10px;
  padding: 8px 10px 9px;
  position: absolute;
  top: 50%;
  z-index: 1080;
  outline: none;
  border: none;
}

.lg-next.disabled,
.lg-prev.disabled {
  opacity: 0 !important;
  cursor: default;
}

.lg-next:hover:not(.disabled),
.lg-prev:hover:not(.disabled) {
  color: #fff;
}

.lg-single-item .lg-next, .lg-single-item
.lg-prev {
  display: none;
}

.lg-next {
  right: 20px;
}

.lg-next:before {
  content: '\e095';
}

.lg-prev {
  left: 20px;
}

.lg-prev:after {
  content: '\e094';
}

@-webkit-keyframes lg-right-end {
  0% {
    left: 0;
  }
  50% {
    left: -30px;
  }
  100% {
    left: 0;
  }
}

@keyframes lg-right-end {
  0% {
    left: 0;
  }
  50% {
    left: -30px;
  }
  100% {
    left: 0;
  }
}

@-webkit-keyframes lg-left-end {
  0% {
    left: 0;
  }
  50% {
    left: 30px;
  }
  100% {
    left: 0;
  }
}

@keyframes lg-left-end {
  0% {
    left: 0;
  }
  50% {
    left: 30px;
  }
  100% {
    left: 0;
  }
}

.lg-outer.lg-right-end .lg-object {
  -webkit-animation: lg-right-end 0.3s;
  animation: lg-right-end 0.3s;
  position: relative;
}

.lg-outer.lg-left-end .lg-object {
  -webkit-animation: lg-left-end 0.3s;
  animation: lg-left-end 0.3s;
  position: relative;
}

.lg-toolbar {
  z-index: 1082;
  left: 0;
  position: absolute;
  top: 0;
  width: 100%;
}

.lg-media-overlap .lg-toolbar {
  background-image: linear-gradient(0deg, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.4));
}

.lg-toolbar .lg-icon {
  color: #999;
  cursor: pointer;
  float: right;
  font-size: 24px;
  height: 47px;
  line-height: 27px;
  padding: 10px 0;
  text-align: center;
  width: 50px;
  text-decoration: none !important;
  outline: medium none;
  will-change: color;
  transition: color 0.2s linear;
  background: none;
  border: none;
  box-shadow: none;
}

.lg-toolbar .lg-icon.lg-icon-18 {
  font-size: 18px;
}

.lg-toolbar .lg-icon:hover {
  color: #fff;
}

.lg-toolbar .lg-close:after {
  content: '\e070';
}

.lg-toolbar .lg-maximize {
  font-size: 22px;
}

.lg-toolbar .lg-maximize:after {
  content: '\e90a';
}

.lg-toolbar .lg-download:after {
  content: '\e0f2';
}

.lg-sub-html {
  color: #eee;
  font-size: 16px;
  padding: 10px 40px;
  text-align: center;
  z-index: 1080;
  opacity: 0;
  transition: opacity 0.2s ease-out 0s;
}

.lg-sub-html h4 {
  margin: 0;
  font-size: 13px;
  font-weight: bold;
}

.lg-sub-html p {
  font-size: 12px;
  margin: 5px 0 0;
}

.lg-sub-html a {
  color: inherit;
}

.lg-sub-html a:hover {
  text-decoration: underline;
}

.lg-media-overlap .lg-sub-html {
  background-image: linear-gradient(180deg, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.6));
}

.lg-item .lg-sub-html {
  position: absolute;
  bottom: 0;
  right: 0;
  left: 0;
}

.lg-error-msg {
  font-size: 14px;
  color: #999;
}

.lg-counter {
  color: #999;
  display: inline-block;
  font-size: 16px;
  padding-left: 20px;
  padding-top: 12px;
  height: 47px;
  vertical-align: middle;
}

.lg-closing .lg-toolbar,
.lg-closing .lg-prev,
.lg-closing .lg-next,
.lg-closing .lg-sub-html {
  opacity: 0;
  transition: transform 0.08 cubic-bezier(0, 0, 0.25, 1) 0s, opacity 0.08 cubic-bezier(0, 0, 0.25, 1) 0s, color 0.08 linear;
}

body:not(.lg-from-hash) .lg-outer.lg-start-zoom .lg-item:not(.lg-zoomable) .lg-img-wrap,
body:not(.lg-from-hash) .lg-outer.lg-start-zoom .lg-item:not(.lg-zoomable) .lg-video-cont {
  opacity: 0;
  transform: scale3d(0.5, 0.5, 0.5);
  will-change: transform, opacity;
  transition: transform 250ms cubic-bezier(0, 0, 0.25, 1) 0s, opacity 250ms cubic-bezier(0, 0, 0.25, 1) !important;
}

body:not(.lg-from-hash) .lg-outer.lg-start-zoom .lg-item:not(.lg-zoomable).lg-complete .lg-img-wrap,
body:not(.lg-from-hash) .lg-outer.lg-start-zoom .lg-item:not(.lg-zoomable).lg-complete .lg-video-cont {
  opacity: 1;
  transform: scale3d(1, 1, 1);
}

.lg-outer .lg-thumb-outer {
  background-color: #0d0a0a;
  width: 100%;
  max-height: 350px;
  overflow: hidden;
  float: left;
}

.lg-outer .lg-thumb-outer.lg-grab .lg-thumb-item {
  cursor: -webkit-grab;
  cursor: -o-grab;
  cursor: -ms-grab;
  cursor: grab;
}

.lg-outer .lg-thumb-outer.lg-grabbing .lg-thumb-item {
  cursor: move;
  cursor: -webkit-grabbing;
  cursor: -o-grabbing;
  cursor: -ms-grabbing;
  cursor: grabbing;
}

.lg-outer .lg-thumb-outer.lg-dragging .lg-thumb {
  transition-duration: 0s !important;
}

.lg-outer .lg-thumb-outer.lg-rebuilding-thumbnails .lg-thumb {
  transition-duration: 0s !important;
}

.lg-outer .lg-thumb-outer.lg-thumb-align-middle {
  text-align: center;
}

.lg-outer .lg-thumb-outer.lg-thumb-align-left {
  text-align: left;
}

.lg-outer .lg-thumb-outer.lg-thumb-align-right {
  text-align: right;
}

.lg-outer.lg-single-item .lg-thumb-outer {
  display: none;
}

.lg-outer .lg-thumb {
  padding: 5px 0;
  height: 100%;
  margin-bottom: -5px;
  display: inline-block;
  vertical-align: middle;
}

@media (min-width: 768px) {
  .lg-outer .lg-thumb {
    padding: 10px 0;
  }
}

.lg-outer .lg-thumb-item {
  cursor: pointer;
  float: left;
  overflow: hidden;
  height: 100%;
  border-radius: 2px;
  margin-bottom: 5px;
  will-change: border-color;
}

@media (min-width: 768px) {
  .lg-outer .lg-thumb-item {
    border-radius: 4px;
    border: 2px solid #fff;
    transition: border-color 0.25s ease;
  }
}

.lg-outer .lg-thumb-item.active, .lg-outer .lg-thumb-item:hover {
  border-color: #a90707;
}

.lg-outer .lg-thumb-item img {
  width: 100%;
  height: 100%;
  -o-object-fit: cover;
     object-fit: cover;
  display: block;
}

.lg-outer.lg-can-toggle .lg-item {
  padding-bottom: 0;
}

.lg-outer .lg-toggle-thumb:after {
  content: '\e1ff';
}

.lg-outer.lg-animate-thumb .lg-thumb {
  transition-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
}

.lg-outer .lg-video-cont {
  text-align: center;
  display: inline-block;
  vertical-align: middle;
  position: relative;
}

.lg-outer .lg-video-cont .lg-object {
  width: 100% !important;
  height: 100% !important;
}

.lg-outer .lg-has-iframe .lg-video-cont {
  -webkit-overflow-scrolling: touch;
  overflow: auto;
}

.lg-outer .lg-video-object {
  position: absolute;
  left: 0;
  right: 0;
  width: 100%;
  height: 100%;
  top: 0;
  bottom: 0;
  z-index: 3;
}

.lg-outer .lg-video-poster {
  z-index: 1;
}

.lg-outer .lg-has-video .lg-video-object {
  opacity: 0;
  will-change: opacity;
  transition: opacity 0.3s ease-in;
}

.lg-outer .lg-has-video.lg-video-loaded .lg-video-poster,
.lg-outer .lg-has-video.lg-video-loaded .lg-video-play-button {
  opacity: 0 !important;
}

.lg-outer .lg-has-video.lg-video-loaded .lg-video-object {
  opacity: 1;
}

@-webkit-keyframes lg-play-stroke {
  0% {
    stroke-dasharray: 1, 200;
    stroke-dashoffset: 0;
  }
  50% {
    stroke-dasharray: 89, 200;
    stroke-dashoffset: -35px;
  }
  100% {
    stroke-dasharray: 89, 200;
    stroke-dashoffset: -124px;
  }
}

@keyframes lg-play-stroke {
  0% {
    stroke-dasharray: 1, 200;
    stroke-dashoffset: 0;
  }
  50% {
    stroke-dasharray: 89, 200;
    stroke-dashoffset: -35px;
  }
  100% {
    stroke-dasharray: 89, 200;
    stroke-dashoffset: -124px;
  }
}

@-webkit-keyframes lg-play-rotate {
  100% {
    transform: rotate(360deg);
  }
}

@keyframes lg-play-rotate {
  100% {
    transform: rotate(360deg);
  }
}

.lg-video-play-button {
  width: 18%;
  max-width: 140px;
  position: absolute;
  top: 50%;
  left: 50%;
  z-index: 2;
  cursor: pointer;
  transform: translate(-50%, -50%) scale(1);
  will-change: opacity, transform;
  transition: transform 0.25s cubic-bezier(0.17, 0.88, 0.32, 1.28), opacity 0.1s;
}

.lg-video-play-button:hover .lg-video-play-icon-bg,
.lg-video-play-button:hover .lg-video-play-icon {
  opacity: 1;
}

.lg-video-play-icon-bg {
  fill: none;
  stroke-width: 3%;
  stroke: #fcfcfc;
  opacity: 0.6;
  will-change: opacity;
  transition: opacity 0.12s ease-in;
}

.lg-video-play-icon-circle {
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  fill: none;
  stroke-width: 3%;
  stroke: rgba(30, 30, 30, 0.9);
  stroke-opacity: 1;
  stroke-linecap: round;
  stroke-dasharray: 200;
  stroke-dashoffset: 200;
}

.lg-video-play-icon {
  position: absolute;
  width: 25%;
  max-width: 120px;
  left: 50%;
  top: 50%;
  transform: translate3d(-50%, -50%, 0);
  opacity: 0.6;
  will-change: opacity;
  transition: opacity 0.12s ease-in;
}

.lg-video-play-icon .lg-video-play-icon-inner {
  fill: #fcfcfc;
}

.lg-video-loading .lg-video-play-icon-circle {
  -webkit-animation: lg-play-rotate 2s linear 0.25s infinite, lg-play-stroke 1.5s ease-in-out 0.25s infinite;
          animation: lg-play-rotate 2s linear 0.25s infinite, lg-play-stroke 1.5s ease-in-out 0.25s infinite;
}

.lg-video-loaded .lg-video-play-button {
  opacity: 0;
  transform: translate(-50%, -50%) scale(0.7);
}

.lg-progress-bar {
  background-color: #333;
  height: 5px;
  left: 0;
  position: absolute;
  top: 0;
  width: 100%;
  z-index: 1083;
  opacity: 0;
  will-change: opacity;
  transition: opacity 0.08s ease 0s;
}

.lg-progress-bar .lg-progress {
  background-color: #a90707;
  height: 5px;
  width: 0;
}

.lg-progress-bar.lg-start .lg-progress {
  width: 100%;
}

.lg-show-autoplay .lg-progress-bar {
  opacity: 1;
}

.lg-autoplay-button:after {
  content: '\e01d';
}

.lg-show-autoplay .lg-autoplay-button:after {
  content: '\e01a';
}

.lg-single-item .lg-autoplay-button {
  opacity: 0.75;
  pointer-events: none;
}

.lg-outer.lg-css3.lg-zoom-dragging .lg-item.lg-complete.lg-zoomable .lg-img-wrap,
.lg-outer.lg-css3.lg-zoom-dragging .lg-item.lg-complete.lg-zoomable .lg-image {
  transition-duration: 0ms !important;
}

.lg-outer.lg-use-transition-for-zoom .lg-item.lg-complete.lg-zoomable .lg-img-wrap {
  will-change: transform;
  transition: transform 0.5s cubic-bezier(0.12, 0.415, 0.01, 1.19) 0s;
}

.lg-outer.lg-use-transition-for-zoom.lg-zoom-drag-transition .lg-item.lg-complete.lg-zoomable .lg-img-wrap {
  will-change: transform;
  transition: transform 0.8s cubic-bezier(0, 0, 0.25, 1) 0s;
}

.lg-outer .lg-item.lg-complete.lg-zoomable .lg-img-wrap {
  transform: translate3d(0, 0, 0);
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
}

.lg-outer .lg-item.lg-complete.lg-zoomable .lg-image,
.lg-outer .lg-item.lg-complete.lg-zoomable .lg-dummy-img {
  transform: scale3d(1, 1, 1);
  will-change: opacity, transform;
  transition: transform 0.5s cubic-bezier(0.12, 0.415, 0.01, 1.19) 0s, opacity 0.15s !important;
  transform-origin: 0 0;
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
}

.lg-icon.lg-zoom-in:after {
  content: '\e311';
}

.lg-icon.lg-actual-size {
  font-size: 20px;
}

.lg-icon.lg-actual-size:after {
  content: '\e033';
}

.lg-icon.lg-zoom-out {
  opacity: 0.5;
  pointer-events: none;
}

.lg-icon.lg-zoom-out:after {
  content: '\e312';
}

.lg-zoomed .lg-icon.lg-zoom-out {
  opacity: 1;
  pointer-events: auto;
}

.lg-outer[data-lg-slide-type='video'] .lg-zoom-in,
.lg-outer[data-lg-slide-type='video'] .lg-actual-size,
.lg-outer[data-lg-slide-type='video'] .lg-zoom-out, .lg-outer[data-lg-slide-type='iframe'] .lg-zoom-in,
.lg-outer[data-lg-slide-type='iframe'] .lg-actual-size,
.lg-outer[data-lg-slide-type='iframe'] .lg-zoom-out, .lg-outer.lg-first-slide-loading .lg-zoom-in,
.lg-outer.lg-first-slide-loading .lg-actual-size,
.lg-outer.lg-first-slide-loading .lg-zoom-out {
  opacity: 0.75;
  pointer-events: none;
}

.lg-outer .lg-pager-outer {
  text-align: center;
  z-index: 1080;
  height: 10px;
  margin-bottom: 10px;
}

.lg-outer .lg-pager-outer.lg-pager-hover .lg-pager-cont {
  overflow: visible;
}

.lg-outer.lg-single-item .lg-pager-outer {
  display: none;
}

.lg-outer .lg-pager-cont {
  cursor: pointer;
  display: inline-block;
  overflow: hidden;
  position: relative;
  vertical-align: top;
  margin: 0 5px;
}

.lg-outer .lg-pager-cont:hover .lg-pager-thumb-cont {
  opacity: 1;
  transform: translate3d(0, 0, 0);
}

.lg-outer .lg-pager-cont.lg-pager-active .lg-pager {
  box-shadow: 0 0 0 2px white inset;
}

.lg-outer .lg-pager-thumb-cont {
  background-color: #fff;
  color: #fff;
  bottom: 100%;
  height: 83px;
  left: 0;
  margin-bottom: 20px;
  margin-left: -60px;
  opacity: 0;
  padding: 5px;
  position: absolute;
  width: 120px;
  border-radius: 3px;
  will-change: transform, opacity;
  transition: opacity 0.15s ease 0s, transform 0.15s ease 0s;
  transform: translate3d(0, 5px, 0);
}

.lg-outer .lg-pager-thumb-cont img {
  width: 100%;
  height: 100%;
}

.lg-outer .lg-pager {
  background-color: rgba(255, 255, 255, 0.5);
  border-radius: 50%;
  box-shadow: 0 0 0 8px rgba(255, 255, 255, 0.7) inset;
  display: block;
  height: 12px;
  transition: box-shadow 0.3s ease 0s;
  width: 12px;
}

.lg-outer .lg-pager:hover, .lg-outer .lg-pager:focus {
  box-shadow: 0 0 0 8px white inset;
}

.lg-outer .lg-caret {
  border-left: 10px solid transparent;
  border-right: 10px solid transparent;
  border-top: 10px dashed;
  bottom: -10px;
  display: inline-block;
  height: 0;
  left: 50%;
  margin-left: -5px;
  position: absolute;
  vertical-align: middle;
  width: 0;
}

.lg-fullscreen:after {
  content: "\e20c";
}

.lg-fullscreen-on .lg-fullscreen:after {
  content: "\e20d";
}

.lg-outer .lg-dropdown-overlay {
  background-color: rgba(0, 0, 0, 0.25);
  bottom: 0;
  cursor: default;
  left: 0;
  position: absolute;
  right: 0;
  top: 0;
  z-index: 1081;
  opacity: 0;
  visibility: hidden;
  will-change: visibility, opacity;
  transition: visibility 0s linear 0.18s, opacity 0.18s linear 0s;
}

.lg-outer.lg-dropdown-active .lg-dropdown,
.lg-outer.lg-dropdown-active .lg-dropdown-overlay {
  transition-delay: 0s;
  transform: translate3d(0, 0px, 0);
  opacity: 1;
  visibility: visible;
}

.lg-outer.lg-dropdown-active .lg-share {
  color: #fff;
}

.lg-outer .lg-dropdown {
  background-color: #fff;
  border-radius: 2px;
  font-size: 14px;
  list-style-type: none;
  margin: 0;
  padding: 10px 0;
  position: absolute;
  right: 0;
  text-align: left;
  top: 50px;
  opacity: 0;
  visibility: hidden;
  transform: translate3d(0, 5px, 0);
  will-change: visibility, opacity, transform;
  transition: transform 0.18s linear 0s, visibility 0s linear 0.5s, opacity 0.18s linear 0s;
}

.lg-outer .lg-dropdown:after {
  content: '';
  display: block;
  height: 0;
  width: 0;
  position: absolute;
  border: 8px solid transparent;
  border-bottom-color: #fff;
  right: 16px;
  top: -16px;
}

.lg-outer .lg-dropdown > li:last-child {
  margin-bottom: 0px;
}

.lg-outer .lg-dropdown > li:hover a {
  color: #333;
}

.lg-outer .lg-dropdown a {
  color: #333;
  display: block;
  white-space: pre;
  padding: 4px 12px;
  font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
  font-size: 12px;
}

.lg-outer .lg-dropdown a:hover {
  background-color: rgba(0, 0, 0, 0.07);
}

.lg-outer .lg-dropdown .lg-dropdown-text {
  display: inline-block;
  line-height: 1;
  margin-top: -3px;
  vertical-align: middle;
}

.lg-outer .lg-dropdown .lg-icon {
  color: #333;
  display: inline-block;
  float: none;
  font-size: 20px;
  height: auto;
  line-height: 1;
  margin-right: 8px;
  padding: 0;
  vertical-align: middle;
  width: auto;
}

.lg-outer .lg-share {
  position: relative;
}

.lg-outer .lg-share:after {
  content: '\e80d';
}

.lg-outer .lg-share-facebook .lg-icon {
  color: #3b5998;
}

.lg-outer .lg-share-facebook .lg-icon:after {
  content: '\e904';
}

.lg-outer .lg-share-twitter .lg-icon {
  color: #00aced;
}

.lg-outer .lg-share-twitter .lg-icon:after {
  content: '\e907';
}

.lg-outer .lg-share-pinterest .lg-icon {
  color: #cb2027;
}

.lg-outer .lg-share-pinterest .lg-icon:after {
  content: '\e906';
}

.lg-comment-box {
  width: 420px;
  max-width: 100%;
  position: absolute;
  right: 0;
  top: 0;
  bottom: 0;
  z-index: 9999;
  background-color: #fff;
  will-change: transform;
  transform: translate3d(100%, 0, 0);
  transition: transform 0.4s cubic-bezier(0, 0, 0.25, 1) 0s;
}

.lg-comment-box .lg-comment-title {
  margin: 0;
  color: #fff;
  font-size: 18px;
}

.lg-comment-box .lg-comment-header {
  background-color: #000;
  padding: 12px 20px;
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
}

.lg-comment-box .lg-comment-body {
  height: 100% !important;
  padding-top: 43px !important;
  width: 100% !important;
}

.lg-comment-box .fb-comments {
  height: 100%;
  width: 100%;
  background: url(/images/vendor/lightgallery/loading.gif?fcba57cdb89652f9bb54271cc5a9cc0e) no-repeat scroll center center #fff;
  overflow-y: auto;
  display: inline-block;
}

.lg-comment-box .fb-comments[fb-xfbml-state='rendered'] {
  background-image: none;
}

.lg-comment-box .fb-comments > span {
  max-width: 100%;
}

.lg-comment-box .lg-comment-close {
  position: absolute;
  right: 5px;
  top: 12px;
  cursor: pointer;
  font-size: 20px;
  color: #999;
  will-change: color;
  transition: color 0.2s linear;
}

.lg-comment-box .lg-comment-close:hover {
  color: #fff;
}

.lg-comment-box .lg-comment-close:after {
  content: '\e070';
}

.lg-comment-box iframe {
  max-width: 100% !important;
  width: 100% !important;
}

.lg-comment-box #disqus_thread {
  padding: 0 20px;
}

.lg-outer .lg-comment-overlay {
  background-color: rgba(0, 0, 0, 0.25);
  bottom: 0;
  cursor: default;
  left: 0;
  position: fixed;
  right: 0;
  top: 0;
  z-index: 1081;
  opacity: 0;
  visibility: hidden;
  will-change: visibility, opacity;
  transition: visibility 0s linear 0.18s, opacity 0.18s linear 0s;
}

.lg-outer .lg-comment-toggle:after {
  content: '\e908';
}

.lg-outer.lg-comment-active .lg-comment-overlay {
  transition-delay: 0s;
  transform: translate3d(0, 0px, 0);
  opacity: 1;
  visibility: visible;
}

.lg-outer.lg-comment-active .lg-comment-toggle {
  color: #fff;
}

.lg-outer.lg-comment-active .lg-comment-box {
  transform: translate3d(0, 0, 0);
}

.lg-outer .lg-img-rotate {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  transition: transform 0.4s cubic-bezier(0, 0, 0.25, 1) 0s;
}

.lg-outer[data-lg-slide-type='video'] .lg-rotate-left,
.lg-outer[data-lg-slide-type='video'] .lg-rotate-right,
.lg-outer[data-lg-slide-type='video'] .lg-flip-ver,
.lg-outer[data-lg-slide-type='video'] .lg-flip-hor, .lg-outer[data-lg-slide-type='iframe'] .lg-rotate-left,
.lg-outer[data-lg-slide-type='iframe'] .lg-rotate-right,
.lg-outer[data-lg-slide-type='iframe'] .lg-flip-ver,
.lg-outer[data-lg-slide-type='iframe'] .lg-flip-hor {
  opacity: 0.75;
  pointer-events: none;
}

.lg-rotate-left:after {
  content: '\e900';
}

.lg-rotate-right:after {
  content: '\e901';
}

.lg-icon.lg-flip-hor, .lg-icon.lg-flip-ver {
  font-size: 26px;
}

.lg-flip-ver:after {
  content: '\e903';
}

.lg-flip-hor:after {
  content: '\e902';
}

.lg-medium-zoom-item {
  cursor: zoom-in;
}

.lg-medium-zoom .lg-outer {
  cursor: zoom-out;
}

.lg-medium-zoom .lg-outer.lg-grab img.lg-object {
  cursor: zoom-out;
}

.lg-medium-zoom .lg-outer.lg-grabbing img.lg-object {
  cursor: zoom-out;
}

.lg-relative-caption .lg-outer .lg-sub-html {
  white-space: normal;
  bottom: auto;
  padding: 0;
  background-image: none;
}

.lg-relative-caption .lg-outer .lg-relative-caption-item {
  opacity: 0;
  padding: 16px 0;
  transition: 0.5s opacity ease;
}

.lg-relative-caption .lg-outer .lg-show-caption .lg-relative-caption-item {
  opacity: 1;
}

.lg-group:after {
  content: '';
  display: table;
  clear: both;
}

.lg-container {
  display: none;
  outline: none;
}

.lg-container.lg-show {
  display: block;
}

.lg-on {
  scroll-behavior: unset;
}

.lg-toolbar,
.lg-prev,
.lg-next,
.lg-pager-outer,
.lg-hide-sub-html .lg-sub-html {
  opacity: 0;
  will-change: transform, opacity;
  transition: transform 0.25s cubic-bezier(0, 0, 0.25, 1) 0s, opacity 0.25s cubic-bezier(0, 0, 0.25, 1) 0s;
}

.lg-show-in .lg-toolbar,
.lg-show-in .lg-prev,
.lg-show-in .lg-next,
.lg-show-in .lg-pager-outer {
  opacity: 1;
}

.lg-show-in.lg-hide-sub-html .lg-sub-html {
  opacity: 1;
}

.lg-show-in .lg-hide-items .lg-prev {
  opacity: 0;
  transform: translate3d(-10px, 0, 0);
}

.lg-show-in .lg-hide-items .lg-next {
  opacity: 0;
  transform: translate3d(10px, 0, 0);
}

.lg-show-in .lg-hide-items .lg-toolbar {
  opacity: 0;
  transform: translate3d(0, -10px, 0);
}

.lg-show-in .lg-hide-items.lg-hide-sub-html .lg-sub-html {
  opacity: 0;
  transform: translate3d(0, 20px, 0);
}

.lg-outer {
  width: 100%;
  height: 100%;
  position: fixed;
  top: 0;
  left: 0;
  z-index: 1050;
  text-align: left;
  opacity: 0.001;
  outline: none;
  will-change: auto;
  overflow: hidden;
  transition: opacity 0.15s ease 0s;
}

.lg-outer * {
  box-sizing: border-box;
}

.lg-outer.lg-zoom-from-image {
  opacity: 1;
}

.lg-outer.lg-visible {
  opacity: 1;
}

.lg-outer.lg-css3 .lg-item:not(.lg-start-end-progress).lg-prev-slide, .lg-outer.lg-css3 .lg-item:not(.lg-start-end-progress).lg-next-slide, .lg-outer.lg-css3 .lg-item:not(.lg-start-end-progress).lg-current {
  transition-duration: inherit !important;
  transition-timing-function: inherit !important;
}

.lg-outer.lg-css3.lg-dragging .lg-item.lg-prev-slide, .lg-outer.lg-css3.lg-dragging .lg-item.lg-next-slide, .lg-outer.lg-css3.lg-dragging .lg-item.lg-current {
  transition-duration: 0s !important;
  opacity: 1;
}

.lg-outer.lg-grab img.lg-object {
  cursor: -webkit-grab;
  cursor: -o-grab;
  cursor: -ms-grab;
  cursor: grab;
}

.lg-outer.lg-grabbing img.lg-object {
  cursor: move;
  cursor: -webkit-grabbing;
  cursor: -o-grabbing;
  cursor: -ms-grabbing;
  cursor: grabbing;
}

.lg-outer .lg-content {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
}

.lg-outer .lg-inner {
  width: 100%;
  position: absolute;
  left: 0;
  top: 0;
  bottom: 0;
  transition: opacity 0s;
  white-space: nowrap;
}

.lg-outer .lg-item {
  display: none !important;
}

.lg-outer .lg-item:not(.lg-start-end-progress) {
  background: url(/images/vendor/lightgallery/loading.gif?fcba57cdb89652f9bb54271cc5a9cc0e) no-repeat scroll center center transparent;
}

.lg-outer.lg-css3 .lg-prev-slide,
.lg-outer.lg-css3 .lg-current,
.lg-outer.lg-css3 .lg-next-slide {
  display: inline-block !important;
}

.lg-outer.lg-css .lg-current {
  display: inline-block !important;
}

.lg-outer .lg-item,
.lg-outer .lg-img-wrap {
  display: inline-block;
  text-align: center;
  position: absolute;
  width: 100%;
  height: 100%;
}

.lg-outer .lg-item:before,
.lg-outer .lg-img-wrap:before {
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle;
}

.lg-outer .lg-img-wrap {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  white-space: nowrap;
  font-size: 0;
}

.lg-outer .lg-item.lg-complete {
  background-image: none;
}

.lg-outer .lg-item.lg-current {
  z-index: 1060;
}

.lg-outer .lg-object {
  display: inline-block;
  vertical-align: middle;
  max-width: 100%;
  max-height: 100%;
  width: auto;
  height: auto;
  position: relative;
}

.lg-outer .lg-empty-html.lg-sub-html,
.lg-outer .lg-empty-html .lg-sub-html {
  display: none;
}

.lg-outer.lg-hide-download .lg-download {
  opacity: 0.75;
  pointer-events: none;
}

.lg-outer .lg-first-slide .lg-dummy-img {
  position: absolute;
  top: 50%;
  left: 50%;
}

.lg-outer.lg-components-open:not(.lg-zoomed) .lg-components {
  transform: translate3d(0, 0%, 0);
  opacity: 1;
}

.lg-outer.lg-components-open:not(.lg-zoomed) .lg-sub-html {
  opacity: 1;
  transition: opacity 0.2s ease-out 0.15s;
}

.lg-backdrop {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: 1040;
  background-color: #000;
  opacity: 0;
  will-change: auto;
  transition: opacity 333ms ease-in 0s;
}

.lg-backdrop.in {
  opacity: 1;
}

.lg-css3.lg-no-trans .lg-prev-slide,
.lg-css3.lg-no-trans .lg-next-slide,
.lg-css3.lg-no-trans .lg-current {
  transition: none 0s ease 0s !important;
}

.lg-css3.lg-use-css3 .lg-item {
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
}

.lg-css3.lg-fade .lg-item {
  opacity: 0;
}

.lg-css3.lg-fade .lg-item.lg-current {
  opacity: 1;
}

.lg-css3.lg-fade .lg-item.lg-prev-slide, .lg-css3.lg-fade .lg-item.lg-next-slide, .lg-css3.lg-fade .lg-item.lg-current {
  transition: opacity 0.1s ease 0s;
}

.lg-css3.lg-use-css3 .lg-item.lg-start-progress {
  transition: transform 1s cubic-bezier(0.175, 0.885, 0.32, 1.275) 0s;
}

.lg-css3.lg-use-css3 .lg-item.lg-start-end-progress {
  transition: transform 1s cubic-bezier(0, 0, 0.25, 1) 0s;
}

.lg-css3.lg-slide.lg-use-css3 .lg-item {
  opacity: 0;
}

.lg-css3.lg-slide.lg-use-css3 .lg-item.lg-prev-slide {
  transform: translate3d(-100%, 0, 0);
}

.lg-css3.lg-slide.lg-use-css3 .lg-item.lg-next-slide {
  transform: translate3d(100%, 0, 0);
}

.lg-css3.lg-slide.lg-use-css3 .lg-item.lg-current {
  transform: translate3d(0, 0, 0);
  opacity: 1;
}

.lg-css3.lg-slide.lg-use-css3 .lg-item.lg-prev-slide, .lg-css3.lg-slide.lg-use-css3 .lg-item.lg-next-slide, .lg-css3.lg-slide.lg-use-css3 .lg-item.lg-current {
  transition: transform 1s cubic-bezier(0, 0, 0.25, 1) 0s, opacity 0.1s ease 0s;
}

.lg-container {
  display: none;
}

.lg-container.lg-show {
  display: block;
}

.lg-container.lg-dragging-vertical .lg-backdrop {
  transition-duration: 0s !important;
}

.lg-container.lg-dragging-vertical .lg-css3 .lg-item.lg-current {
  transition-duration: 0s !important;
  opacity: 1;
}

.lg-inline .lg-backdrop,
.lg-inline .lg-outer {
  position: absolute;
}

.lg-inline .lg-backdrop {
  z-index: 1;
}

.lg-inline .lg-outer {
  z-index: 2;
}

.lg-inline .lg-maximize:after {
  content: '\e909';
}

.lg-components {
  transform: translate3d(0, 100%, 0);
  will-change: transform;
  transition: transform 0.35s ease-out 0s;
  z-index: 1080;
  position: absolute;
  bottom: 0;
  right: 0;
  left: 0;
}

.shop-section .price-section .min input::-moz-placeholder, .shop-section .price-section .max input::-moz-placeholder, .modal-body .main .search input::-moz-placeholder, .customers-navbar .search-brand-user-wishlist-cart-section .holder .search-holder .search input::-moz-placeholder {
  color: #585555;
  font-size: 13px;
  letter-spacing: 1px;
  font-weight: 400;
  line-height: 23px;
}
.shop-section .price-section .min input:-ms-input-placeholder, .shop-section .price-section .max input:-ms-input-placeholder, .modal-body .main .search input:-ms-input-placeholder, .customers-navbar .search-brand-user-wishlist-cart-section .holder .search-holder .search input:-ms-input-placeholder {
  color: #585555;
  font-size: 13px;
  letter-spacing: 1px;
  font-weight: 400;
  line-height: 23px;
}
.paragraph, .product-details-section #sizeGuideModel .switches span, .product-details-section .informations-section .product-details-accordion .accordion-item .accordion-body .measurements-size ul, .product-details-section .informations-section .product-details-accordion .accordion-item .accordion-body, .product-details-section .informations-section .options .sizes .size-blocks-holder .holder, .shop-section .price-section .min input::placeholder,
.shop-section .price-section .max input::placeholder, .shop-section .price-section .min input,
.shop-section .price-section .max input, .shop-section .price-section .min,
.shop-section .price-section .max, .shop-section .menus-categories-filters-section .son-filter-block, .shop-section .categories-header-section, .shop-section .filter-section .filter-right-section .clear-all, .shop-section .filter-section .filter-right-section .products-number, .shop-section .filter-section .filter-left-section .filter-modal-button, .shop-section .filter-section .toper-section, .shop-section .filter-section .clear-all, .success-alert, .modal-body .main .search input, .modal-body .main .search input::placeholder, .customers-footer .subscribe-section .subscribe-form form input, .customers-navbar .search-brand-user-wishlist-cart-section .holder .search-holder .search input, .customers-navbar .search-brand-user-wishlist-cart-section .holder .search-holder .search input::placeholder, .no-outline-select, .shop-filter-button, .shop-section .filter-section .filter-keys-section .keys .key, .shop-section .filter-section .filter-right-section .sort-by .sort-select, .shop-section .filter-section .filter-left-section .filters-keys-menus .filters-menus .filter-block .shop-filter-menus-dropdown-toggle, .text, .shop-report-filter-header .value, .shop-section .filter-section .filter-right-section .sort-by .filter-header .value, .shop-section .filter-section .filter-left-section .filters-keys-menus .filter-header .value, .offers-link, .customers-navbar .upbar-section .holder a {
  color: #585555;
  font-size: 13px;
  letter-spacing: 1px;
  font-weight: 400;
  line-height: 23px;
}

.offers-link, .customers-navbar .upbar-section .holder a {
  font-size: 13px;
}

.authentication-container .form-card input::-moz-placeholder, .authentication-container .account-section-container input::-moz-placeholder {
  color: #3a3636;
  font-size: 14px;
  letter-spacing: 1px;
  font-weight: 500;
  cursor: pointer;
  text-transform: lowercase;
}

.authentication-container .form-card input:-ms-input-placeholder, .authentication-container .account-section-container input:-ms-input-placeholder {
  color: #3a3636;
  font-size: 14px;
  letter-spacing: 1px;
  font-weight: 500;
  cursor: pointer;
  text-transform: lowercase;
}

.link, .authentication-container .account-section-container .navigation-section .logout-link, .modal-body .links-blocks-holder .link-block .authentication-container .account-section-container .navigation-section a.logout-link, .authentication-container .account-section-container .navigation-section .modal-body .links-blocks-holder .link-block a.logout-link, .modal-body .user-holder .user-paragraphs, .modal-body .links-blocks-holder .link-block .user-holder a.user-paragraphs, .modal-body .user-holder .links-blocks-holder .link-block a.user-paragraphs, .modal-body .links-blocks-holder .link-block a.link, .modal-body .links-blocks-holder .link-block a.small-link, .modal-body .links-blocks-holder .link-block a.sub-link, .modal-body .links-blocks-holder .link-block a.authentication-font, .modal-body .links-blocks-holder .link-block .authentication-container .account-section-container .navigation-section a.navigation-link, .authentication-container .account-section-container .navigation-section .modal-body .links-blocks-holder .link-block a.navigation-link, .modal-body .links-blocks-holder .link-block .authentication-container .form-card a.cancel, .authentication-container .form-card .modal-body .links-blocks-holder .link-block a.cancel,
.modal-body .links-blocks-holder .link-block .authentication-container .account-section-container a.cancel,
.authentication-container .account-section-container .modal-body .links-blocks-holder .link-block a.cancel, .modal-body .links-blocks-holder .link-block .authentication-container .form-card .forget-password a, .authentication-container .form-card .forget-password .modal-body .links-blocks-holder .link-block a,
.modal-body .links-blocks-holder .link-block .authentication-container .form-card .create-account a,
.authentication-container .form-card .create-account .modal-body .links-blocks-holder .link-block a,
.modal-body .links-blocks-holder .link-block .authentication-container .form-card .login a,
.authentication-container .form-card .login .modal-body .links-blocks-holder .link-block a,
.modal-body .links-blocks-holder .link-block .authentication-container .account-section-container .forget-password a,
.authentication-container .account-section-container .forget-password .modal-body .links-blocks-holder .link-block a,
.modal-body .links-blocks-holder .link-block .authentication-container .account-section-container .create-account a,
.authentication-container .account-section-container .create-account .modal-body .links-blocks-holder .link-block a,
.modal-body .links-blocks-holder .link-block .authentication-container .account-section-container .login a,
.authentication-container .account-section-container .login .modal-body .links-blocks-holder .link-block a, .modal-body .links-blocks-holder .link-block .authentication-container .form-card a.auth-text, .authentication-container .form-card .modal-body .links-blocks-holder .link-block a.auth-text,
.modal-body .links-blocks-holder .link-block .authentication-container .account-section-container a.auth-text,
.authentication-container .account-section-container .modal-body .links-blocks-holder .link-block a.auth-text, .modal-body .links-blocks-holder .link-block .customers-navbar .links-section .holder .links a, .customers-navbar .links-section .holder .links .modal-body .links-blocks-holder .link-block a, .modal-body .links-blocks-holder .link-block .customers-footer a.last-section, .customers-footer .modal-body .links-blocks-holder .link-block a.last-section, .customers-navbar .links-section .holder .links a, .sub-link, .customers-footer .last-section, .authentication-font, .authentication-container .account-section-container .navigation-section .navigation-link, .authentication-container .form-card a.cancel,
.authentication-container .account-section-container a.cancel, .authentication-container .form-card .forget-password a,
.authentication-container .form-card .create-account a,
.authentication-container .form-card .login a,
.authentication-container .account-section-container .forget-password a,
.authentication-container .account-section-container .create-account a,
.authentication-container .account-section-container .login a, .authentication-container .form-card input::placeholder,
.authentication-container .account-section-container input::placeholder, .authentication-container .form-card input,
.authentication-container .account-section-container input, .authentication-container .form-card .auth-text,
.authentication-container .account-section-container .auth-text, .authentication-container .form-card .my-errors ul li,
.authentication-container .account-section-container .my-errors ul li, .small-link {
  color: #3a3636;
  font-size: 14px;
  letter-spacing: 1px;
  font-weight: 500;
  cursor: pointer;
  text-transform: lowercase;
}

.small-link {
  font-size: 12px;
}

.white-header, .home-section .categories-section .category-block .content-holder .name, .home-section .categories-section .category-block .content-holder .product-content .price, .product-content .home-section .categories-section .category-block .content-holder .price {
  font-size: 27px;
  color: #fff;
  font-weight: 600;
  text-transform: lowercase;
}

.mega-header, .header, .links-header {
  color: #3a3636;
  text-align: center;
  font-size: 22px;
  font-weight: 600;
}

.header, .links-header {
  text-transform: lowercase;
  font-weight: 500;
  font-size: 18px;
}

.shop-report-filter-header, .shop-section .filter-section .filter-right-section .sort-by .filter-header, .shop-section .filter-section .filter-left-section .filters-keys-menus .filter-header {
  letter-spacing: 1px;
  text-transform: capitalize;
  color: #585555;
  font-weight: 500;
  font-size: 14px;
}
.links-header {
  text-align: left;
  font-size: 16px;
  font-weight: 500;
}

.text {
  max-width: 450px;
  margin: auto;
  text-align: center;
  font-size: 14px;
  line-height: 27px;
}

.product-content {
  text-align: center;
  margin-top: -20px;
}
.product-content .name, .product-content .price {
  color: #3a3636;
  font-weight: 600;
  margin: 15px 0px 7px;
  font-size: 15px;
  text-transform: lowercase;
  letter-spacing: 0px;
}
.product-content .price {
  margin: 0px;
  text-transform: uppercase;
}
.product-content .price .old-price {
  margin-left: 5px;
  font-weight: 400;
  text-decoration: line-through;
  color: #c5c4c4;
}
.product-content .category {
  position: relative;
  top: 5px;
  background: #ffeeee;
  padding: 3px 12px;
  border-radius: 3px;
  color: #3a3636;
  display: inline-block;
}

.product-details-name, .product-details-section #sizeGuideModel .modal-header .name, .product-details-section #sizeGuideModel .modal-header .product-content .price, .product-content .product-details-section #sizeGuideModel .modal-header .price, .product-details-section .informations-section .name, .product-details-price, .product-details-section .informations-section .price {
  color: #3a3636;
  font-weight: 500;
  font-size: 18px;
  text-transform: capitalize;
  letter-spacing: 0px;
}

.product-details-price, .product-details-section .informations-section .price {
  text-transform: uppercase;
  font-size: 16px !important;
}
.product-details-price .old-price, .product-details-section .informations-section .price .old-price {
  margin-left: 5px;
  font-weight: 300;
  text-decoration: line-through;
  color: #c5c4c4;
}

.category-name {
  color: #3a3636;
  font-weight: 600;
  margin: 18px 0px;
  font-size: 15px;
  text-transform: lowercase;
  letter-spacing: 0px;
}

.authentication-container .form-card input::-moz-placeholder, .authentication-container .account-section-container input::-moz-placeholder {
  font-weight: 400;
  color: #585555 !important;
}

.authentication-container .form-card input:-ms-input-placeholder, .authentication-container .account-section-container input:-ms-input-placeholder {
  font-weight: 400;
  color: #585555 !important;
}

.sub-link, .customers-footer .last-section, .authentication-font, .authentication-container .account-section-container .navigation-section .navigation-link, .authentication-container .form-card a.cancel,
.authentication-container .account-section-container a.cancel, .authentication-container .form-card .forget-password a,
.authentication-container .form-card .create-account a,
.authentication-container .form-card .login a,
.authentication-container .account-section-container .forget-password a,
.authentication-container .account-section-container .create-account a,
.authentication-container .account-section-container .login a, .authentication-container .form-card input::placeholder,
.authentication-container .account-section-container input::placeholder, .authentication-container .form-card input,
.authentication-container .account-section-container input, .authentication-container .form-card .auth-text,
.authentication-container .account-section-container .auth-text, .authentication-container .form-card .my-errors ul li,
.authentication-container .account-section-container .my-errors ul li {
  font-weight: 400;
  color: #585555 !important;
}

.authentication-container .form-card input::-moz-placeholder, .authentication-container .account-section-container input::-moz-placeholder {
  color: #585555 !important;
  font-weight: 400 !important;
}

.authentication-container .form-card input:-ms-input-placeholder, .authentication-container .account-section-container input:-ms-input-placeholder {
  color: #585555 !important;
  font-weight: 400 !important;
}

.authentication-font, .authentication-container .account-section-container .navigation-section .navigation-link, .authentication-container .form-card a.cancel,
.authentication-container .account-section-container a.cancel, .authentication-container .form-card .forget-password a,
.authentication-container .form-card .create-account a,
.authentication-container .form-card .login a,
.authentication-container .account-section-container .forget-password a,
.authentication-container .account-section-container .create-account a,
.authentication-container .account-section-container .login a, .authentication-container .form-card input::placeholder,
.authentication-container .account-section-container input::placeholder, .authentication-container .form-card input,
.authentication-container .account-section-container input, .authentication-container .form-card .auth-text,
.authentication-container .account-section-container .auth-text, .authentication-container .form-card .my-errors ul li,
.authentication-container .account-section-container .my-errors ul li {
  color: #585555 !important;
  font-weight: 400 !important;
}

@media (max-width: 768px) {
  .text {
    max-width: 400px;
  }

  .white-header, .home-section .categories-section .category-block .content-holder .name, .home-section .categories-section .category-block .content-holder .product-content .price, .product-content .home-section .categories-section .category-block .content-holder .price {
    font-size: 23px;
  }
}
@media (max-width: 550px) {
  .links-header {
    font-size: 15px !important;
  }

  .mega-header, .header, .links-header {
    font-size: 16px;
  }

  .product-content .name, .product-content .price {
    font-weight: 500;
    font-size: 13px;
  }
  .product-content .category {
    font-size: 13px;
  }

  .text {
    font-size: 13px;
    line-height: 23px;
  }

  .category-name {
    font-weight: 500;
    font-size: 14px;
  }
}
@media (max-width: 450px) {
  .white-header, .home-section .categories-section .category-block .content-holder .name, .home-section .categories-section .category-block .content-holder .product-content .price, .product-content .home-section .categories-section .category-block .content-holder .price {
    font-size: 23px;
    font-weight: 400;
  }
}
.fluid-container, .product-details-section, .shop-section .products-content-holder .shop-products-section, .shop-section .products-content-holder, .shop-section .filter-section, .customers-footer .last-section, .customers-footer .links-section, .customers-navbar .links-section .holder, .customers-navbar .search-brand-user-wishlist-cart-section .holder, .side-section-container, .home-section .share-section, .home-section .video-section, .seperator-section-container, .product-details-section .deals-section, .home-section .deals-section, .home-section .categories-section {
  max-width: 1200px;
  margin: auto;
}

.bg-image, .home-section .video-section .cover {
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
}

.seperator-section-container, .product-details-section .deals-section, .home-section .deals-section, .home-section .categories-section {
  padding: 100px 30px;
}

.side-section-container, .home-section .share-section, .home-section .video-section {
  padding: 0px 30px;
}

.flex-father, .shop-section .products-content-holder .shop-products-section, .home-section .share-section .images-holder, .customers-footer .subscribe-section .subscribe-form form {
  display: flex;
  flex-wrap: wrap;
  flex: 1 1 auto;
}

@media (max-width: 1192px) {
  .seperator-section-container, .product-details-section .deals-section, .home-section .deals-section, .home-section .categories-section {
    padding: 90px 30px !important;
  }

  .side-section-container, .home-section .share-section, .home-section .video-section {
    padding: 0px 30px !important;
  }
}
@media (max-width: 768px) {
  .side-section-container, .home-section .share-section, .home-section .video-section {
    padding: 0px 20px !important;
  }
}
@media (max-width: 550px) {
  .seperator-section-container, .product-details-section .deals-section, .home-section .deals-section, .home-section .categories-section {
    padding: 60px 20px !important;
  }

  .side-section-container, .home-section .share-section, .home-section .video-section {
    padding: 0px 20px !important;
  }
}
@media (max-width: 450px) {
  .bordered-section-button {
    font-size: 0.9rem !important;
    border-bottom: 2px solid white !important;
  }
}
#main_content {
  width: 100%;
  overflow: hidden !important;
}

.card-box-shadow {
  box-shadow: rgba(100, 100, 111, 0.13) 0px 7px 29px 0px !important;
}

.hover-effect, .home-section .video-section .cover, .home-section .sliders-section #small-screen-sliders, .home-section .sliders-section #big-screen-sliders .slider-block, .image-container {
  position: relative;
  cursor: pointer;
}
.hover-effect::before, .home-section .video-section .cover::before, .home-section .sliders-section #small-screen-sliders::before, .home-section .sliders-section #big-screen-sliders .slider-block::before, .image-container::before {
  content: "";
  display: block;
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  width: 100%;
  height: 100%;
  background: rgba(108, 108, 108, 0.6);
  opacity: 0.1;
  z-index: 99 !important;
}
.hover-effect:hover::before, .home-section .video-section .cover:hover::before, .home-section .sliders-section #small-screen-sliders:hover::before, .home-section .sliders-section #big-screen-sliders .slider-block:hover::before, .image-container:hover::before {
  display: none !important;
}

.hide-scroll {
  height: 100vh !important;
  overflow: hidden !important;
}

.no-focus:focus, .shop-section .price-section .min input:focus,
.shop-section .price-section .max input:focus, .shop-section .filter-section .filter-right-section .sort-by .sort-select:focus, .modal-body .main .search input:focus, .customers-footer .subscribe-section .subscribe-form form input:focus, .customers-navbar .search-brand-user-wishlist-cart-section .holder .search-holder .search input:focus {
  outline: none !important;
  box-shadow: none !important;
}

.clearing {
  clear: both;
}

.modal-open {
  padding-right: 0px !important;
}

.showContent {
  opacity: 1 !important;
}

.hovered {
  transition: 0.2s all ease;
}
.hovered:hover {
  color: #ffafaf !important;
  cursor: pointer;
}

.card-box-shadow {
  box-shadow: rgba(100, 100, 111, 0.13) 0px 7px 29px 0px !important;
}

.opacity-false {
  opacity: 0 !important;
  transition: 1s all ease;
}

.opacityFalse, .shop-section .menus-categories-filters-section .son-filter-block .shop-filter-icon-holder i {
  opacity: 0;
  transition: 0.3s all ease-in-out;
}

.opacityTrue {
  opacity: 1 !important;
}

.stretch {
  max-width: 800px !important;
}

.transparent::before {
  background: transparent !important;
}

.initial-position {
  background-position: initial !important;
}

.lower {
  text-transform: lowercase !important;
}

.l-sp-0 {
  letter-spacing: 0px !important;
}

.no-font-family {
  font-family: unset !important;
}

.hidden {
  opacity: 0 !important;
}

.white-bordered-bottom-button, .home-section .categories-section .category-block .content-holder .shop-button-holder span {
  font-size: 20px;
  font-weight: 400;
  color: #fff;
  text-transform: uppercase;
  border-bottom: 2px solid #fff;
}

.shop-filter-button, .shop-section .filter-section .filter-keys-section .keys .key, .shop-section .filter-section .filter-right-section .sort-by .sort-select, .shop-section .filter-section .filter-left-section .filters-keys-menus .filters-menus .filter-block .shop-filter-menus-dropdown-toggle {
  cursor: pointer;
  padding: 0px 9px 2px;
  border: 1px solid #d1d1d1;
  font-size: 12px !important;
  margin-top: 10px;
}
.shop-filter-button i, .shop-section .filter-section .filter-keys-section .keys .key i, .shop-section .filter-section .filter-right-section .sort-by .sort-select i, .shop-section .filter-section .filter-left-section .filters-keys-menus .filters-menus .filter-block .shop-filter-menus-dropdown-toggle i {
  font-size: 10px !important;
}
.shop-filter-button:hover, .shop-section .filter-section .filter-keys-section .keys .key:hover, .shop-section .filter-section .filter-right-section .sort-by .sort-select:hover, .shop-section .filter-section .filter-left-section .filters-keys-menus .filters-menus .filter-block .shop-filter-menus-dropdown-toggle:hover {
  border-color: #3a3636;
}

.no-outline-select {
  border: none !important;
}

.big-black-button, .authentication-container .form-card button,
.authentication-container .account-section-container button {
  background: #000;
  padding: 10px 60px;
  font-size: 12px;
  letter-spacing: 1px;
  text-transform: capitalize;
  color: #fff;
  text-align: center;
  display: inline-block;
}

.add-to-cart-button, .product-details-section .informations-section .cart button, .product-details-section .informations-section .availability-report .holder button {
  background: #ffafaf;
  border: 1px solid #ffafaf;
  padding: 12px 0px;
  font-size: 13px;
  letter-spacing: 1px;
  text-transform: capitalize;
  transition: 0.3s all ease;
  color: #fff;
  text-align: center;
  display: block;
  width: 300px;
}
.add-to-cart-button:hover, .product-details-section .informations-section .cart button:hover, .product-details-section .informations-section .availability-report .holder button:hover {
  border: 1px solid black;
  background-color: white;
  color: black;
}

@media (max-width: 768px) {
  .white-bordered-bottom-button, .home-section .categories-section .category-block .content-holder .shop-button-holder span {
    font-size: 16px;
  }

  .light-radius-button {
    padding: 5px 16px;
  }
}
@media (max-width: 630px) {
  .shop-filter-key-button {
    padding: 0px 8px 2px;
    font-size: 11px !important;
  }
}
.fade-in {
  -webkit-animation: fadeIn 3s;
          animation: fadeIn 3s;
}

@keyframes fadeIn {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}
@-webkit-keyframes fadeIn {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}
.product-card-loader {
  z-index: 999 !important;
  transition: 1s all;
  display: inline-block;
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0px;
  left: 0px;
  z-index: 999 !important;
  overflow: hidden;
  background-color: transparent;
}
.product-card-loader::after {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  transform: translateX(-100%);
  opacity: 0.9;
  background-image: linear-gradient(90deg, rgba(218, 220, 214, 0) 0, rgba(20, 63, 85, 0.2) 20%, rgba(214, 218, 220, 0.5) 60%, rgba(214, 218, 220, 0));
  -webkit-animation: shimmer 1300ms infinite;
          animation: shimmer 1300ms infinite;
  content: "";
}
@-webkit-keyframes shimmer {
  100% {
    transform: translateX(100%);
  }
}
@keyframes shimmer {
  100% {
    transform: translateX(100%);
  }
}

.link-left-to-right::after, .modal-body .main .search::after, .customers-navbar .links-section .holder .links a::after, .customers-navbar .search-brand-user-wishlist-cart-section .holder .search-holder .search::after {
  content: "";
  position: absolute;
  width: 100%;
  transform: scaleX(0);
  border-radius: 5px;
  height: 2px;
  bottom: 0;
  left: 0;
  background: #ffafaf;
  transform-origin: bottom right;
  transition: transform 0.4s ease-out;
  color: #ffafaf !important;
  text-decoration: none !important;
}
.link-left-to-right:hover::after, .modal-body .main .search:hover::after, .customers-navbar .links-section .holder .links a:hover::after, .customers-navbar .search-brand-user-wishlist-cart-section .holder .search-holder .search:hover::after {
  transform: scaleX(1);
  transform-origin: bottom left;
}

.customers-navbar {
  height: 195px;
  min-height: 195px;
  position: relative;
}
.customers-navbar .upbar-section {
  border-bottom: 1px solid #ebebeb;
  text-align: center;
}
.customers-navbar .upbar-section .holder {
  display: inline-block;
  cursor: pointer;
  padding: 15px 20px;
}
.customers-navbar .upbar-section .holder a:hover {
  text-decoration: none !important;
}
.customers-navbar .upbar-section .holder img {
  cursor: pointer;
  width: 18px;
  margin-left: 10px;
}
.customers-navbar .search-brand-user-wishlist-cart-section .holder {
  display: flex;
  flex-wrap: wrap;
  flex: 1 1 auto;
  padding: 20px 20px !important;
}
.customers-navbar .search-brand-user-wishlist-cart-section .holder .bars-image-holder {
  display: none;
}
.customers-navbar .search-brand-user-wishlist-cart-section .holder .search-holder {
  flex: 0 0 40%;
  max-width: 40%;
}
.customers-navbar .search-brand-user-wishlist-cart-section .holder .search-holder .search {
  display: inline-block;
  position: relative;
  min-width: 276px;
}
.customers-navbar .search-brand-user-wishlist-cart-section .holder .search-holder .search:after {
  top: 33px;
  background: #3a3636;
  height: 1px !important;
}
.customers-navbar .search-brand-user-wishlist-cart-section .holder .search-holder .search input {
  border: none;
  border-radius: 0px !important;
  padding-bottom: 18px !important;
}
.customers-navbar .search-brand-user-wishlist-cart-section .holder .brand {
  flex: 0 0 20%;
  max-width: 20%;
  text-align: center;
}
.customers-navbar .search-brand-user-wishlist-cart-section .holder .brand .image {
  width: 80px;
}
.customers-navbar .search-brand-user-wishlist-cart-section .holder .user-wishlist-cart {
  flex: 0 0 40%;
  max-width: 40%;
  padding-top: 5px;
  text-align: right;
}
.customers-navbar .search-brand-user-wishlist-cart-section .holder .user-wishlist-cart .wishlist, .customers-navbar .search-brand-user-wishlist-cart-section .holder .user-wishlist-cart .cart, .customers-navbar .search-brand-user-wishlist-cart-section .holder .user-wishlist-cart .user {
  margin-left: 15px;
  display: inline-block;
  cursor: pointer;
}
.customers-navbar .search-brand-user-wishlist-cart-section .holder button {
  position: absolute;
  top: -5px;
  right: 20px;
}
.customers-navbar .search-brand-user-wishlist-cart-section .holder button .search-image {
  width: 16px;
}
.customers-navbar .search-brand-user-wishlist-cart-section .holder .heart-image, .customers-navbar .search-brand-user-wishlist-cart-section .holder .user-image, .customers-navbar .search-brand-user-wishlist-cart-section .holder .bars-image,
.customers-navbar .search-brand-user-wishlist-cart-section .holder .cart-image {
  width: 20px;
}
@media (max-width: 992px) {
  .customers-navbar .search-brand-user-wishlist-cart-section .holder .search-holder {
    flex: 0 0 33.33%;
    max-width: 33.33%;
  }
  .customers-navbar .search-brand-user-wishlist-cart-section .holder .brand {
    flex: 0 0 33.33%;
    max-width: 33.33%;
  }
  .customers-navbar .search-brand-user-wishlist-cart-section .holder .user-wishlist-cart {
    flex: 0 0 33.33%;
    max-width: 33.33%;
  }
}
@media (max-width: 768px) {
  .customers-navbar .search-brand-user-wishlist-cart-section .holder {
    padding: 20px 10px !important;
  }
  .customers-navbar .search-brand-user-wishlist-cart-section .holder .search-holder {
    display: none;
  }
  .customers-navbar .search-brand-user-wishlist-cart-section .holder .bars-image-holder {
    display: block;
    cursor: pointer;
    flex: 0 0 33.33%;
    max-width: 33.33%;
  }
  .customers-navbar .search-brand-user-wishlist-cart-section .holder .user-wishlist-cart {
    padding-top: 0px;
  }
}
@media (max-width: 600px) {
  .customers-navbar .search-brand-user-wishlist-cart-section .holder span.disapered {
    display: none;
  }
}
@media (max-width: 768px) {
  .customers-navbar .search-brand-user-wishlist-cart-section {
    box-shadow: rgba(100, 100, 111, 0.13) 0px 5px 10px 0px !important;
  }
}
.customers-navbar .links-section {
  background-color: #fbf6f6;
}
.customers-navbar .links-section .holder {
  display: flex;
  justify-content: center;
  padding: 20px 20px 20px;
}
.customers-navbar .links-section .holder .links {
  display: inline-block;
}
.customers-navbar .links-section .holder .links a {
  position: relative;
  margin: 0px 20px;
  display: inline-block;
  cursor: pointer;
  text-decoration: none !important;
}
.customers-navbar .links-section .holder .links a:after {
  top: 30px;
}
@media (max-width: 992px) {
  .customers-navbar .links-section .holder .links a {
    margin: 0px 8px;
    font-size: 14px !important;
  }
}
@media (max-width: 768px) {
  .customers-navbar .links-section .holder {
    display: none;
  }
}
.customers-navbar .sticky-navbar {
  background-color: white;
  z-index: 999 !important;
}
.customers-navbar .sticky {
  position: fixed;
  width: 100%;
  left: 0;
  top: 0;
  border-top: 0;
}
@media (max-width: 768px) {
  .customers-navbar {
    height: 130px;
    min-height: 130px;
  }
}

.customers-footer .subscribe-section {
  padding: 40px 20px;
}
.customers-footer .subscribe-section .content-holder {
  padding: 30px 0px;
  border-top: 1px solid #ebebeb;
  border-bottom: 1px solid #ebebeb;
}
.customers-footer .subscribe-section .text {
  max-width: 600px;
  margin-top: 10px;
  margin-bottom: 5px;
}
.customers-footer .subscribe-section .subscribe-form {
  margin-top: 20px;
  text-align: center;
}
.customers-footer .subscribe-section .subscribe-form form {
  justify-content: center;
}
.customers-footer .subscribe-section .subscribe-form form input {
  flex: 0 0 276px;
  max-width: 0 0 276px;
  padding: 12px 8px !important;
  border: 1px solid #ebebeb;
  border-radius: 3px !important;
}
.customers-footer .subscribe-section .subscribe-form form input:focus {
  border: 1px solid #ebebeb;
}
.customers-footer .subscribe-section .subscribe-form i {
  cursor: pointer;
  position: relative;
  left: -45px;
  font-size: 20px !important;
  color: black;
}
.customers-footer .subscribe-section .subscribe-form .subscribe-button {
  border: none !important;
  background-color: transparent !important;
  width: 0px !important;
}
@media (max-width: 550px) {
  .customers-footer .subscribe-section .subscribe-form {
    margin-top: 20px !important;
  }
}
.customers-footer .links-section {
  padding-bottom: 30px;
  display: flex;
  flex-wrap: wrap;
  flex: 1 1 auto;
}
.customers-footer .links-section .header, .customers-footer .links-section .links-header {
  margin-bottom: 10px;
}
.customers-footer .links-section .links-block {
  display: flex;
  justify-content: center;
  flex: 0 0 25%;
  max-width: 25%;
}
.customers-footer .links-section .links-block .links-holder {
  min-width: 151px;
  display: inline-block;
}
.customers-footer .links-section .links-block .links-holder .authentication-container .form-card input::-moz-placeholder, .authentication-container .form-card .customers-footer .links-section .links-block .links-holder input::-moz-placeholder, .customers-footer .links-section .links-block .links-holder .authentication-container .account-section-container input::-moz-placeholder, .authentication-container .account-section-container .customers-footer .links-section .links-block .links-holder input::-moz-placeholder {
  display: inline-block;
  position: relative;
  margin-bottom: 10px;
}
.customers-footer .links-section .links-block .links-holder .authentication-container .form-card input:-ms-input-placeholder, .authentication-container .form-card .customers-footer .links-section .links-block .links-holder input:-ms-input-placeholder, .customers-footer .links-section .links-block .links-holder .authentication-container .account-section-container input:-ms-input-placeholder, .authentication-container .account-section-container .customers-footer .links-section .links-block .links-holder input:-ms-input-placeholder {
  display: inline-block;
  position: relative;
  margin-bottom: 10px;
}
.customers-footer .links-section .links-block .links-holder .sub-link, .customers-footer .links-section .links-block .links-holder .last-section, .customers-footer .links-section .links-block .links-holder .authentication-font, .customers-footer .links-section .links-block .links-holder .authentication-container .account-section-container .navigation-section .navigation-link, .authentication-container .account-section-container .navigation-section .customers-footer .links-section .links-block .links-holder .navigation-link, .customers-footer .links-section .links-block .links-holder .authentication-container .form-card a.cancel, .authentication-container .form-card .customers-footer .links-section .links-block .links-holder a.cancel,
.customers-footer .links-section .links-block .links-holder .authentication-container .account-section-container a.cancel,
.authentication-container .account-section-container .customers-footer .links-section .links-block .links-holder a.cancel, .customers-footer .links-section .links-block .links-holder .authentication-container .form-card .forget-password a, .authentication-container .form-card .forget-password .customers-footer .links-section .links-block .links-holder a,
.customers-footer .links-section .links-block .links-holder .authentication-container .form-card .create-account a,
.authentication-container .form-card .create-account .customers-footer .links-section .links-block .links-holder a,
.customers-footer .links-section .links-block .links-holder .authentication-container .form-card .login a,
.authentication-container .form-card .login .customers-footer .links-section .links-block .links-holder a,
.customers-footer .links-section .links-block .links-holder .authentication-container .account-section-container .forget-password a,
.authentication-container .account-section-container .forget-password .customers-footer .links-section .links-block .links-holder a,
.customers-footer .links-section .links-block .links-holder .authentication-container .account-section-container .create-account a,
.authentication-container .account-section-container .create-account .customers-footer .links-section .links-block .links-holder a,
.customers-footer .links-section .links-block .links-holder .authentication-container .account-section-container .login a,
.authentication-container .account-section-container .login .customers-footer .links-section .links-block .links-holder a, .customers-footer .links-section .links-block .links-holder .authentication-container .form-card input::placeholder, .authentication-container .form-card .customers-footer .links-section .links-block .links-holder input::placeholder,
.customers-footer .links-section .links-block .links-holder .authentication-container .account-section-container input::placeholder,
.authentication-container .account-section-container .customers-footer .links-section .links-block .links-holder input::placeholder, .customers-footer .links-section .links-block .links-holder .authentication-container .form-card input, .authentication-container .form-card .customers-footer .links-section .links-block .links-holder input,
.customers-footer .links-section .links-block .links-holder .authentication-container .account-section-container input,
.authentication-container .account-section-container .customers-footer .links-section .links-block .links-holder input, .customers-footer .links-section .links-block .links-holder .authentication-container .form-card .auth-text, .authentication-container .form-card .customers-footer .links-section .links-block .links-holder .auth-text,
.customers-footer .links-section .links-block .links-holder .authentication-container .account-section-container .auth-text,
.authentication-container .account-section-container .customers-footer .links-section .links-block .links-holder .auth-text, .customers-footer .links-section .links-block .links-holder .authentication-container .form-card .my-errors ul li, .authentication-container .form-card .my-errors ul .customers-footer .links-section .links-block .links-holder li,
.customers-footer .links-section .links-block .links-holder .authentication-container .account-section-container .my-errors ul li,
.authentication-container .account-section-container .my-errors ul .customers-footer .links-section .links-block .links-holder li {
  display: inline-block;
  position: relative;
  margin-bottom: 10px;
}
.customers-footer .links-section .links-block .links-holder .authentication-container .form-card input:hover::-moz-placeholder, .authentication-container .form-card .customers-footer .links-section .links-block .links-holder input:hover::-moz-placeholder, .customers-footer .links-section .links-block .links-holder .authentication-container .account-section-container input:hover::-moz-placeholder, .authentication-container .account-section-container .customers-footer .links-section .links-block .links-holder input:hover::-moz-placeholder {
  text-decoration: underline;
}
.customers-footer .links-section .links-block .links-holder .authentication-container .form-card input:hover:-ms-input-placeholder, .authentication-container .form-card .customers-footer .links-section .links-block .links-holder input:hover:-ms-input-placeholder, .customers-footer .links-section .links-block .links-holder .authentication-container .account-section-container input:hover:-ms-input-placeholder, .authentication-container .account-section-container .customers-footer .links-section .links-block .links-holder input:hover:-ms-input-placeholder {
  text-decoration: underline;
}
.customers-footer .links-section .links-block .links-holder .sub-link:hover, .customers-footer .links-section .links-block .links-holder .last-section:hover, .customers-footer .links-section .links-block .links-holder .authentication-font:hover, .customers-footer .links-section .links-block .links-holder .authentication-container .account-section-container .navigation-section .navigation-link:hover, .authentication-container .account-section-container .navigation-section .customers-footer .links-section .links-block .links-holder .navigation-link:hover, .customers-footer .links-section .links-block .links-holder .authentication-container .form-card a.cancel:hover, .authentication-container .form-card .customers-footer .links-section .links-block .links-holder a.cancel:hover,
.customers-footer .links-section .links-block .links-holder .authentication-container .account-section-container a.cancel:hover,
.authentication-container .account-section-container .customers-footer .links-section .links-block .links-holder a.cancel:hover, .customers-footer .links-section .links-block .links-holder .authentication-container .form-card .forget-password a:hover, .authentication-container .form-card .forget-password .customers-footer .links-section .links-block .links-holder a:hover,
.customers-footer .links-section .links-block .links-holder .authentication-container .form-card .create-account a:hover,
.authentication-container .form-card .create-account .customers-footer .links-section .links-block .links-holder a:hover,
.customers-footer .links-section .links-block .links-holder .authentication-container .form-card .login a:hover,
.authentication-container .form-card .login .customers-footer .links-section .links-block .links-holder a:hover,
.customers-footer .links-section .links-block .links-holder .authentication-container .account-section-container .forget-password a:hover,
.authentication-container .account-section-container .forget-password .customers-footer .links-section .links-block .links-holder a:hover,
.customers-footer .links-section .links-block .links-holder .authentication-container .account-section-container .create-account a:hover,
.authentication-container .account-section-container .create-account .customers-footer .links-section .links-block .links-holder a:hover,
.customers-footer .links-section .links-block .links-holder .authentication-container .account-section-container .login a:hover,
.authentication-container .account-section-container .login .customers-footer .links-section .links-block .links-holder a:hover, .customers-footer .links-section .links-block .links-holder .authentication-container .form-card input:hover::placeholder, .authentication-container .form-card .customers-footer .links-section .links-block .links-holder input:hover::placeholder,
.customers-footer .links-section .links-block .links-holder .authentication-container .account-section-container input:hover::placeholder,
.authentication-container .account-section-container .customers-footer .links-section .links-block .links-holder input:hover::placeholder, .customers-footer .links-section .links-block .links-holder .authentication-container .form-card input:hover, .authentication-container .form-card .customers-footer .links-section .links-block .links-holder input:hover,
.customers-footer .links-section .links-block .links-holder .authentication-container .account-section-container input:hover,
.authentication-container .account-section-container .customers-footer .links-section .links-block .links-holder input:hover, .customers-footer .links-section .links-block .links-holder .authentication-container .form-card .auth-text:hover, .authentication-container .form-card .customers-footer .links-section .links-block .links-holder .auth-text:hover,
.customers-footer .links-section .links-block .links-holder .authentication-container .account-section-container .auth-text:hover,
.authentication-container .account-section-container .customers-footer .links-section .links-block .links-holder .auth-text:hover, .customers-footer .links-section .links-block .links-holder .authentication-container .form-card .my-errors ul li:hover, .authentication-container .form-card .my-errors ul .customers-footer .links-section .links-block .links-holder li:hover,
.customers-footer .links-section .links-block .links-holder .authentication-container .account-section-container .my-errors ul li:hover,
.authentication-container .account-section-container .my-errors ul .customers-footer .links-section .links-block .links-holder li:hover {
  text-decoration: underline;
}
.customers-footer .links-section .links-block .social-media {
  text-align: center;
  margin-top: 20px;
  display: flex;
}
.customers-footer .links-section .links-block .social-media a img {
  width: 25px;
  margin: 0px 8px;
}
.customers-footer .links-section .links-block .social-media a i {
  font-size: 20px;
  margin-right: 20px;
}
.customers-footer .links-section .links-block .social-media a .fa-facebook-f {
  color: #3a3636 !important;
}
.customers-footer .links-section .links-block .social-media a .fa-twitter {
  color: #3a3636 !important;
}
.customers-footer .links-section .links-block .social-media a .fa-instagram {
  color: #3a3636 !important;
}
@media (max-width: 992px) {
  .customers-footer .links-section .links-block {
    flex: 0 0 50%;
    max-width: 50%;
  }
  .customers-footer .links-section .links-block:nth-of-type(3) {
    margin-top: 40px;
  }
  .customers-footer .links-section .links-block:nth-of-type(4) {
    margin-top: 40px;
  }
}
.customers-footer .last-section {
  padding: 20px;
  border-top: 1px solid #ebebeb;
  text-align: center;
  cursor: text;
}

.modal.left .modal-dialog {
  position: fixed;
  margin: auto;
  width: 300px;
  height: 100%;
}

.modal.left .modal-content {
  height: 100%;
  overflow-y: auto;
}

.modal.left .modal-body {
  padding: 0px !important;
}

/* ----- MODAL STYLE ----- */
.modal-content {
  border-radius: 0px !important;
  border: none;
  top: -1px;
}

.modal-body {
  border-radius: 0px !important;
}
.modal-body .main {
  width: 87%;
  margin: 5px auto;
  margin-top: 30px;
}
.modal-body .main .search {
  display: inline-block;
  position: relative;
  min-width: 246px;
}
.modal-body .main .search:after {
  top: 33px;
  background: #3a3636;
  height: 1px !important;
}
.modal-body .main .search input {
  border: none;
  border-bottom: 1px solid #c5c4c4;
  border-radius: 0px !important;
  padding-bottom: 18px !important;
}
.modal-body .main .search button {
  position: absolute;
  top: -5px;
  right: 20px;
}
.modal-body .main .search button .search-image {
  width: 16px;
}
.modal-body .links-blocks-holder {
  margin-top: 30px;
}
.modal-body .links-blocks-holder .link-block {
  padding: 10px 20px 10px 20px;
  cursor: pointer;
}
.modal-body .links-blocks-holder .link-block:hover .icon i,
.modal-body .links-blocks-holder .link-block:hover a {
  color: #ffafaf !important;
}
.modal-body .links-blocks-holder .link-block img {
  width: 50px;
  display: inline-block;
  margin-right: 15px;
}
.modal-body .links-blocks-holder .link-block a.link, .modal-body .links-blocks-holder .link-block .authentication-container .account-section-container .navigation-section a.logout-link, .authentication-container .account-section-container .navigation-section .modal-body .links-blocks-holder .link-block a.logout-link, .modal-body .links-blocks-holder .link-block .user-holder a.user-paragraphs, .modal-body .user-holder .links-blocks-holder .link-block a.user-paragraphs, .modal-body .links-blocks-holder .link-block a.small-link, .modal-body .links-blocks-holder .link-block a.sub-link, .modal-body .links-blocks-holder .link-block a.authentication-font, .modal-body .links-blocks-holder .link-block .authentication-container .account-section-container .navigation-section a.navigation-link, .authentication-container .account-section-container .navigation-section .modal-body .links-blocks-holder .link-block a.navigation-link, .modal-body .links-blocks-holder .link-block .authentication-container .form-card a.cancel, .authentication-container .form-card .modal-body .links-blocks-holder .link-block a.cancel,
.modal-body .links-blocks-holder .link-block .authentication-container .account-section-container a.cancel,
.authentication-container .account-section-container .modal-body .links-blocks-holder .link-block a.cancel, .modal-body .links-blocks-holder .link-block .authentication-container .form-card .forget-password a, .authentication-container .form-card .forget-password .modal-body .links-blocks-holder .link-block a,
.modal-body .links-blocks-holder .link-block .authentication-container .form-card .create-account a,
.authentication-container .form-card .create-account .modal-body .links-blocks-holder .link-block a,
.modal-body .links-blocks-holder .link-block .authentication-container .form-card .login a,
.authentication-container .form-card .login .modal-body .links-blocks-holder .link-block a,
.modal-body .links-blocks-holder .link-block .authentication-container .account-section-container .forget-password a,
.authentication-container .account-section-container .forget-password .modal-body .links-blocks-holder .link-block a,
.modal-body .links-blocks-holder .link-block .authentication-container .account-section-container .create-account a,
.authentication-container .account-section-container .create-account .modal-body .links-blocks-holder .link-block a,
.modal-body .links-blocks-holder .link-block .authentication-container .account-section-container .login a,
.authentication-container .account-section-container .login .modal-body .links-blocks-holder .link-block a, .modal-body .links-blocks-holder .link-block .authentication-container .form-card a.auth-text, .authentication-container .form-card .modal-body .links-blocks-holder .link-block a.auth-text,
.modal-body .links-blocks-holder .link-block .authentication-container .account-section-container a.auth-text,
.authentication-container .account-section-container .modal-body .links-blocks-holder .link-block a.auth-text, .modal-body .links-blocks-holder .link-block .customers-navbar .links-section .holder .links a, .customers-navbar .links-section .holder .links .modal-body .links-blocks-holder .link-block a, .modal-body .links-blocks-holder .link-block .customers-footer a.last-section, .customers-footer .modal-body .links-blocks-holder .link-block a.last-section {
  text-decoration: none !important;
  display: inline-block;
  padding-left: 5px;
  cursor: pointer;
}
.modal-body .links-blocks-holder .link-block .active, .modal-body .links-blocks-holder .link-block .shop-section .pagination-section #pagination_pages_links li:hover, .shop-section .pagination-section #pagination_pages_links .modal-body .links-blocks-holder .link-block li:hover {
  color: #ffafaf !important;
}
.modal-body .links-blocks-holder .link-block .active + .icon i, .modal-body .links-blocks-holder .link-block .shop-section .pagination-section #pagination_pages_links li:hover + .icon i, .shop-section .pagination-section #pagination_pages_links .modal-body .links-blocks-holder .link-block li:hover + .icon i {
  color: #ffafaf !important;
}
.modal-body .links-blocks-holder .link-block .icon {
  cursor: pointer;
  margin-top: 20px;
  float: right;
  padding-right: 10px;
  text-align: right;
}
.modal-body .links-blocks-holder .link-block .icon a {
  text-decoration: none !important;
  color: #3a3636 !important;
}
.modal-body .links-blocks-holder .link-block .icon i {
  font-size: 13px !important;
}
.modal-body .user-holder {
  margin: 10px 0px 0px 30px;
}
.modal-body .user-holder .user-image {
  display: inline-block;
  width: 25px;
  cursor: pointer;
}
.modal-body .user-holder .user-paragraphs {
  display: inline-block;
  margin-left: 20px;
  margin-top: 15px;
  cursor: pointer;
}
.modal-body .user-holder .user-paragraphs a {
  color: #3a3636 !important;
}
.modal-body .user-holder .user-paragraphs a:hover {
  text-decoration: none !important;
  color: #ffafaf !important;
}
.modal-body .social-media-holder {
  padding-left: 20px;
}
.modal-body .social-media-holder .social-media {
  display: inline-block;
  text-align: center;
  margin-top: 20px;
  padding-bottom: 40px;
}
.modal-body .social-media-holder .social-media a {
  text-decoration: none;
  float: left;
  color: #3a3636;
  border: 1px solid #3a3636;
  height: 35px;
  width: 35px;
  border-radius: 50%;
  margin: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.modal-body .social-media-holder .social-media a:hover {
  text-decoration: none;
}
.modal-body .social-media-holder .social-media a:hover {
  color: #ffafaf;
  border-color: #ffafaf;
}

/* ----- v CAN BE DELETED v ----- */
[data-toggle=collapse] .fa:before {
  content: "\f139";
}

[data-toggle=collapse].collapsed .fa:before {
  content: "\f13a";
}

body.modal-open {
  height: 100vh;
  overflow-y: hidden;
}

.success-alert {
  text-align: center !important;
  padding-left: 20px !important;
  padding-right: 20px !important;
  background-color: #fffad9 !important;
  border-color: white !important;
  margin-bottom: 0px !important;
}
.success-alert .close span {
  color: #3a3636 !important;
}

@media (max-width: 650px) {
  .zomm-image {
    cursor: unset !important;
  }
}
.error-page-container {
  padding-top: 70px;
}
.error-page-container a {
  color: #3a3636 !important;
  text-decoration: underline;
}
.error-page-container a:hover {
  color: #3a3636 !important;
}
.error-page-container .text {
  margin-top: 10px;
}

.authentication-container {
  padding: 30px 0px 0px;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  flex: 1 1 auto;
}
.authentication-container input {
  border: 1px solid #d7d7d7 !important;
}
.authentication-container .form-card,
.authentication-container .account-section-container {
  flex: 0 0 600px;
  max-width: 600px;
  background-color: rgba(255, 255, 255, 0.8);
  padding: 25px 50px;
}
.authentication-container .form-card .my-errors,
.authentication-container .account-section-container .my-errors {
  margin: 1rem 0 1rem 2rem;
  text-align: left;
  font-size: 14px;
  line-height: 18px;
  letter-spacing: 1px;
  color: #3a3636;
}
.authentication-container .form-card .my-errors ul li,
.authentication-container .account-section-container .my-errors ul li {
  margin-bottom: 10px;
}
.authentication-container .form-card .auth-text,
.authentication-container .account-section-container .auth-text {
  text-align: center;
  margin: 0.5rem auto 1rem;
  line-height: 20px;
}
.authentication-container .form-card input,
.authentication-container .account-section-container input {
  width: 100%;
  border: 0;
  margin: 1.5rem 0 0;
  padding: 22px 15px;
  line-height: 18px;
}
.authentication-container .form-card input:focus,
.authentication-container .account-section-container input:focus {
  outline: none !important;
  box-shadow: none !important;
}
.authentication-container .form-card .forget-password,
.authentication-container .form-card .create-account,
.authentication-container .form-card .login,
.authentication-container .account-section-container .forget-password,
.authentication-container .account-section-container .create-account,
.authentication-container .account-section-container .login {
  text-align: right;
  margin: 15px 0px;
}
.authentication-container .form-card .forget-password a,
.authentication-container .form-card .create-account a,
.authentication-container .form-card .login a,
.authentication-container .account-section-container .forget-password a,
.authentication-container .account-section-container .create-account a,
.authentication-container .account-section-container .login a {
  text-decoration: underline !important;
}
.authentication-container .form-card .create-account,
.authentication-container .form-card .login,
.authentication-container .account-section-container .create-account,
.authentication-container .account-section-container .login {
  text-align: center;
}
.authentication-container .form-card .buttons-holder,
.authentication-container .account-section-container .buttons-holder {
  text-align: center;
  padding: 20px 0px 0px;
}
.authentication-container .form-card button,
.authentication-container .account-section-container button {
  text-align: center;
}
.authentication-container .form-card a.cancel,
.authentication-container .account-section-container a.cancel {
  display: inline-block;
  margin-top: 20px;
  text-decoration: underline !important;
  text-align: center;
}
.authentication-container .account-section-container {
  padding: 50px 20px;
  flex: 0 0 1600px;
  max-width: 1200px;
  display: flex;
  flex-wrap: wrap;
  flex: 1 1 auto;
}
.authentication-container .account-section-container .navigation-section {
  flex: 0 0 250px;
  max-width: 250px;
}
.authentication-container .account-section-container .navigation-section .navigation-block {
  margin: 12px 0px;
}
.authentication-container .account-section-container .navigation-section a:hover {
  color: #3a3636 !important;
}
.authentication-container .account-section-container .navigation-section .navigation-link {
  text-transform: uppercase !important;
  font-size: 17px !important;
  color: #585555 !important;
  font-weight: 400 !important;
}
.authentication-container .account-section-container .navigation-section .items-number {
  display: inline-block;
  font-size: 12px;
  color: #fff;
  background: black;
  height: 20px !important;
  width: 20px !important;
  border-radius: 50%;
  margin: 0px 0px 0px 8px;
  position: relative;
  top: -3px;
  padding: 0px 0px 0px 6px;
}
.authentication-container .account-section-container .navigation-section .logout-link {
  text-decoration: underline;
  font-size: 17px !important;
}
.authentication-container .account-section-container .form-section {
  flex: 0 0 calc(100% - 250px);
  max-width: calc(100% - 250px);
  position: relative;
}
.authentication-container .account-section-container .form-section .form-card input::-moz-placeholder, .authentication-container .form-card .account-section-container .form-section input::-moz-placeholder, .authentication-container .account-section-container .form-section input::-moz-placeholder {
  padding-left: 10px;
  margin-bottom: 5px !important;
}
.authentication-container .account-section-container .form-section .form-card input:-ms-input-placeholder, .authentication-container .form-card .account-section-container .form-section input:-ms-input-placeholder, .authentication-container .account-section-container .form-section input:-ms-input-placeholder {
  padding-left: 10px;
  margin-bottom: 5px !important;
}
.authentication-container .account-section-container .form-section .authentication-font, .authentication-container .form-card .my-errors ul .account-section-container .form-section li,
.authentication-container .account-section-container .form-section .my-errors ul li,
.authentication-container .account-section-container .my-errors ul .form-section li,
.authentication-container .account-section-container .form-section .auth-text, .authentication-container .account-section-container .form-section .form-card input, .authentication-container .form-card .account-section-container .form-section input,
.authentication-container .account-section-container .form-section input, .authentication-container .account-section-container .form-section .form-card input::placeholder, .authentication-container .form-card .account-section-container .form-section input::placeholder,
.authentication-container .account-section-container .form-section input::placeholder, .authentication-container .form-card .forget-password .account-section-container .form-section a,
.authentication-container .form-card .create-account .account-section-container .form-section a,
.authentication-container .form-card .login .account-section-container .form-section a,
.authentication-container .account-section-container .form-section .forget-password a,
.authentication-container .account-section-container .forget-password .form-section a,
.authentication-container .account-section-container .form-section .create-account a,
.authentication-container .account-section-container .create-account .form-section a,
.authentication-container .account-section-container .form-section .login a,
.authentication-container .account-section-container .login .form-section a,
.authentication-container .account-section-container .form-section a.cancel, .authentication-container .account-section-container .form-section .navigation-section .navigation-link, .authentication-container .account-section-container .navigation-section .form-section .navigation-link {
  padding-left: 10px;
  margin-bottom: 5px !important;
}
.authentication-container .account-section-container .form-section input {
  margin: 0px 0px 20px 0px !important;
}
.authentication-container .account-section-container .form-section p.authentication-font,
.authentication-container .account-section-container .form-section p.auth-text, .authentication-container .account-section-container .form-section .navigation-section p.navigation-link, .authentication-container .account-section-container .navigation-section .form-section p.navigation-link {
  padding-left: 0px !important;
  margin-top: 10px !important;
}
.authentication-container .account-section-container .form-section > div {
  display: none;
}
.authentication-container .account-section-container #orders_informations {
  display: block;
}
.authentication-container .account-section-container .form-section > div {
  position: absolute;
  top: 0px;
  left: 0px;
  width: 100%;
  height: 100%;
}
.authentication-container .account-section-container #account_informations input {
  max-width: 80% !important;
}
.authentication-container .account-section-container .address-buttons-holder {
  margin-top: 2px;
}
@media (max-width: 992px) {
  .authentication-container .form-section {
    margin-top: 20px;
    flex: 0 0 100% !important;
    max-width: 100% !important;
  }
  .authentication-container .form-section input {
    max-width: 100% !important;
  }
  .authentication-container .navigation-section {
    flex: 0 0 100% !important;
    max-width: 100% !important;
  }
}
@media (max-width: 768px) {
  .authentication-container .account-section-container {
    padding: 20px 20px 30px !important;
  }
  .authentication-container .account-section-container .navigation-section .navigation-block {
    margin: 8px 0px !important;
  }
  .authentication-container .account-section-container .navigation-link {
    font-size: 17px !important;
  }
  .authentication-container .form-card {
    flex: 0 0 92% !important;
    max-width: 92% !important;
    margin: auto !important;
    padding: 25px 20px 0px !important;
  }
  .authentication-container .col-6 {
    padding: 8px !important;
  }
}

@media (max-width: 550px) {
  .form-card {
    flex: 0 0 400px !important;
    max-width: 400px !important;
  }
}
.home-section .sliders-section {
  overflow: hidden !important;
}
.home-section .sliders-section #big-screen-sliders .owl-dots {
  z-index: 999 !important;
  position: absolute;
  top: calc(50% - 30px);
  right: 30px;
}
.home-section .sliders-section #big-screen-sliders .owl-dots .owl-dot {
  display: block !important;
}
.home-section .sliders-section #big-screen-sliders .owl-dots .owl-dot span {
  background-color: #ebebeb;
  width: 13px !important;
  height: 13px !important;
}
.home-section .sliders-section #big-screen-sliders .owl-dots .active span, .home-section .sliders-section #big-screen-sliders .owl-dots .shop-section .pagination-section #pagination_pages_links li:hover span, .shop-section .pagination-section #pagination_pages_links .home-section .sliders-section #big-screen-sliders .owl-dots li:hover span {
  background-color: #fff !important;
}
.home-section .sliders-section #big-screen-sliders .owl-nav {
  display: none;
}
.home-section .sliders-section #small-screen-sliders {
  cursor: pointer;
  position: relative;
  display: none;
}
.home-section .sliders-section #small-screen-sliders .owl-dots {
  display: none !important;
}
.home-section .sliders-section #small-screen-sliders .owl-nav {
  display: none;
}
@media (max-width: 992px) {
  .home-section .sliders-section #big-screen-sliders {
    display: none;
  }
  .home-section .sliders-section #small-screen-sliders {
    display: block;
    max-height: 1000px;
  }
}
.home-section .categories-section a:hover {
  text-decoration: none !important;
}
.home-section .categories-section .category-block {
  background-color: white !important;
  cursor: pointer;
  position: relative;
}
.home-section .categories-section .category-block .category-name {
  margin: 15px 0px;
  text-align: center;
}
.home-section .categories-section .category-block .category-name img {
  width: 20px;
  display: inline-block;
  margin-left: 10px;
  margin-top: -3px;
}
.home-section .categories-section .category-block .content-holder {
  position: absolute;
  margin-top: 30%;
}
.home-section .categories-section .category-block .content-holder .shop-button-holder {
  display: block;
  text-align: center;
  margin-top: 150px;
}
@media (max-width: 768px) {
  .home-section .categories-section .content-holder {
    margin-top: 38% !important;
  }
  .home-section .categories-section .content-holder .shop-button-holder {
    margin-top: 100px !important;
  }
}
@media (max-width: 450px) {
  .home-section .categories-section .content-holder {
    margin-top: 48% !important;
  }
  .home-section .categories-section .content-holder .shop-button-holder {
    margin-top: 60px !important;
  }
}
.home-section .categories-section .categories-owl-carousel {
  margin-top: 20px;
}
.home-section .categories-section .categories-owl-carousel .owl-dots {
  display: none;
}
.home-section .categories-section .categories-owl-carousel .owl-nav {
  margin-top: 0px !important;
  display: block !important;
}
.home-section .categories-section .categories-owl-carousel .owl-nav button {
  position: absolute;
  top: calc(50% - 55px);
  background: white;
  padding: 8px 6px 10px !important;
  border-radius: 0% !important;
  opacity: 0.8;
  transition: 0.2s all ease;
  margin: 0px !important;
}
.home-section .categories-section .categories-owl-carousel .owl-nav button i {
  color: #3a3636 !important;
  font-size: 12px !important;
}
.home-section .categories-section .categories-owl-carousel .owl-nav button:nth-child(1) {
  left: 0px;
}
.home-section .categories-section .categories-owl-carousel .owl-nav button:nth-child(2) {
  right: 0px;
}
.home-section .categories-section .categories-owl-carousel .owl-nav button:hover {
  opacity: 1;
}
.home-section .categories-section .categories-owl-carousel .owl-nav svg {
  width: 8px !important;
}
.home-section .categories-section .text {
  margin-top: 10px;
  margin-bottom: 5px;
}
.home-section .video-section .cover {
  position: relative;
  background-image: url("/videos/good.webp");
}
.home-section .video-section .cover video {
  opacity: 0;
  width: 100%;
  transition: 1s;
  height: calc(100% + 20px) !important;
}
.home-section .video-section .cover #play_vedio_button {
  position: absolute;
  top: calc(50% - 18px);
  opacity: 1;
  left: calc(50% - 30px);
  background: #1a1919;
  height: 36px;
  width: 60px;
  color: white;
  border-radius: 5px;
}
.home-section .video-section .cover #play_vedio_button i {
  color: white !important;
}
@media (max-width: 550px) {
  .home-section .video-section .cover #play_vedio_button {
    height: 24px;
    width: 40px;
    top: calc(50% - 12px);
    left: calc(50% - 20px);
  }
  .home-section .video-section .cover #play_vedio_button i {
    font-size: 10px !important;
    position: relative;
    top: -3px;
  }
}
.home-section .deals-section {
  margin-top: -20px !important;
}
.home-section .deals-section a {
  text-decoration: none !important;
}
.home-section .deals-section .deals-owl-carousel {
  margin-top: 20px;
}
.home-section .deals-section .deals-owl-carousel .owl-dots {
  display: none;
}
.home-section .deals-section .deals-owl-carousel .owl-nav {
  margin-top: 0px !important;
}
.home-section .deals-section .deals-owl-carousel .owl-nav button {
  position: absolute;
  top: calc(50% - 55px);
  background: white;
  padding: 8px 6px 10px !important;
  border-radius: 0% !important;
  opacity: 0.8;
  transition: 0.2s all ease;
  margin: 0px !important;
}
.home-section .deals-section .deals-owl-carousel .owl-nav button i {
  color: #3a3636 !important;
  font-size: 12px !important;
}
.home-section .deals-section .deals-owl-carousel .owl-nav button:nth-child(1) {
  left: 0px;
}
.home-section .deals-section .deals-owl-carousel .owl-nav button:nth-child(2) {
  right: 0px;
}
.home-section .deals-section .deals-owl-carousel .owl-nav button:hover {
  opacity: 1;
}
.home-section .deals-section .deals-owl-carousel .owl-nav svg {
  width: 8px !important;
}
.home-section .deals-section .text {
  margin-top: 10px;
  margin-bottom: 5px;
}
.home-section .share-section {
  margin-top: -30px;
}
.home-section .share-section .images-holder {
  margin-top: 20px;
}
.home-section .share-section .images-holder .image-block {
  flex: 0 0 33.33%;
  cursor: pointer;
  position: relative;
}
.home-section .share-section .images-holder .image-block::before {
  content: "";
  display: block;
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  width: 100%;
  height: 100%;
  background: rgba(10, 10, 10, 0.6);
  opacity: 0;
  transition: 0.3s all ease;
}
.home-section .share-section .images-holder .image-block:hover::before {
  opacity: 0.9;
}
.home-section .share-section .images-holder .image-block:hover .icon-holder i {
  opacity: 1;
}
.home-section .share-section .images-holder .icon-holder {
  position: absolute;
  left: calc(50% - 14px);
  top: calc(50% - 11px);
}
.home-section .share-section .images-holder .icon-holder i {
  color: white;
  font-size: 25px;
  opacity: 0;
  transition: 0.3s all ease;
}
.home-section .share-section .images-holder img {
  width: 100%;
}
.home-section .share-section .text {
  margin-top: 10px;
  margin-bottom: 5px;
}
.home-section #lg-next-1::before, .home-section #lg-next-1::after,
.home-section #lg-prev-1::before,
.home-section #lg-prev-1::after {
  color: white !important;
}
@media (max-width: 768px) {
  .home-section .images-holder .image-block {
    flex: 0 0 50%;
    max-width: 0 0 50% !important;
  }
  .home-section .icon-holder i {
    font-size: 20px !important;
  }
}
.home-section .lg-outer.lg-grab img.lg-object {
  max-width: 500px !important;
  width: 500px !important;
}
.home-section .lg-outer .lg-img-wrap {
  max-width: 500px !important;
  display: none !important;
}

.shop-section .heading-section {
  margin-top: 11px;
  padding: 30px 20px;
  background: #fbf6f6;
  border-top: 1px solid white;
}
.shop-section .heading-section .text {
  max-width: 800px;
  margin: auto;
  margin-top: 8px;
}
@media (max-width: 768px) {
  .shop-section .heading-section {
    padding: 20px 20px !important;
  }
}
.shop-section .filter-section {
  padding: 40px 20px 0px;
}
.shop-section .filter-section .toper-section {
  margin-bottom: 15px;
  display: none;
}
.shop-section .filter-section .toper-section .clear-all {
  display: inline-block !important;
  margin-left: 20px;
  border-bottom: 1px solid gray;
  cursor: pointer;
}
.shop-section .filter-section .filter-left-section {
  margin-top: 3px;
  width: 68%;
  display: inline-block;
}
.shop-section .filter-section .filter-left-section .filters-keys-menus {
  padding: 0px 0px 10px;
}
.shop-section .filter-section .filter-left-section .filters-keys-menus .filter-header {
  display: inline-block;
}
.shop-section .filter-section .filter-left-section .filters-keys-menus .filters-menus {
  width: calc(100% - 60px);
  display: inline-block;
}
.shop-section .filter-section .filter-left-section .filters-keys-menus .filters-menus .filter-block {
  margin-right: 5px;
  display: inline-block;
  position: relative;
}
.shop-section .filter-section .filter-left-section .filters-keys-menus .filters-menus .filter-block .active, .shop-section .filter-section .filter-left-section .filters-keys-menus .filters-menus .filter-block .pagination-section #pagination_pages_links li:hover, .shop-section .pagination-section #pagination_pages_links .filter-section .filter-left-section .filters-keys-menus .filters-menus .filter-block li:hover {
  border-color: #3a3636;
}
.shop-section .filter-section .filter-left-section .clear-all {
  display: none;
  margin-top: 5px;
}
.shop-section .filter-section .filter-left-section .filter-modal-button {
  display: none;
  text-transform: capitalize;
  cursor: pointer;
}
.shop-section .filter-section .filter-left-section .filter-modal-button .head {
  border-bottom: 1px solid gray;
  cursor: pointer;
}
.shop-section .filter-section .filter-right-section {
  width: 32%;
  text-align: right;
  float: right;
}
.shop-section .filter-section .filter-right-section .sort-by {
  position: relative;
  left: 20px;
  display: inline-block;
}
.shop-section .filter-section .filter-right-section .sort-by .filter-header {
  display: inline-block;
}
.shop-section .filter-section .filter-right-section .sort-by .sort-select {
  padding-right: 25px !important;
}
.shop-section .filter-section .filter-right-section .sort-by i {
  font-size: 10px !important;
  color: #585555 !important;
  position: relative;
  left: -23px;
}
.shop-section .filter-section .filter-right-section .products-number {
  margin-left: 40px;
  position: relative;
  top: 25px;
  color: gray !important;
}
.shop-section .filter-section .filter-right-section .clear-all {
  display: inline-block;
  position: relative;
  top: 3px;
  border-bottom: 1px solid gray;
  cursor: pointer;
}
.shop-section .filter-section .filter-keys-section {
  padding: 10px 0px 10px;
}
.shop-section .filter-section .filter-keys-section .keys {
  display: inline-block;
}
.shop-section .filter-section .filter-keys-section .keys .key {
  display: inline-block;
  position: relative;
  margin-right: 10px;
  margin-bottom: 10px;
  border: none !important;
  border-bottom: 1px solid #d1d1d1 !important;
  padding: 0px 3px 0px !important;
  margin-right: 15px;
  margin-top: 0px !important;
}
.shop-section .filter-section .filter-keys-section .keys .key:hover {
  border-color: #3a3636 !important;
}
@media (max-width: 768px) {
  .shop-section .filter-left-section {
    width: 100% !important;
  }
  .shop-section .filter-left-section .filters-menus {
    width: unset !important;
  }
  .shop-section .filter-left-section .shop-menus-clear-all {
    display: block !important;
    border-bottom: 1px solid gray;
    cursor: pointer;
    float: right;
  }
  .shop-section .filter-right-section {
    width: 100% !important;
    float: none !important;
    text-align: left !important;
    margin-bottom: 10px !important;
    margin-top: 10px !important;
  }
  .shop-section .filter-right-section .products-number {
    margin-left: 0px;
    margin-top: 5px;
    position: unset !important;
    float: right;
  }
  .shop-section .filter-right-section .sort-by {
    left: 0px !important;
  }
  .shop-section .filter-right-section .sort-select {
    margin-left: 18px;
  }
}
@media (max-width: 550px) {
  .shop-section .filter-section .toper-section {
    display: block;
  }
  .shop-section .filter-section .toper-section .clear-all {
    display: inline-block !important;
  }
  .shop-section .filter-section .filter-left-section .clear-all {
    display: none !important;
  }
  .shop-section .filter-section .filter-right-section .products-number {
    display: none !important;
  }
}
@media (max-width: 368px) {
  .shop-section .filter-section .filter-left-section .filter-header {
    position: relative;
    top: -30px;
  }
  .shop-section .filter-section .filter-left-section .filter-block {
    margin-bottom: 5px;
  }
}
.shop-section ul.shop-filter-menu {
  display: none;
  position: absolute;
  top: 100%;
  z-index: 100 !important;
  padding: 10px 0px;
  border: 1px solid #ebebeb;
  margin-top: 5px;
  background-color: white;
  width: 250px;
}
.shop-section ul.shop-filter-menu li {
  list-style-type: none;
}
.shop-section ul.shop-filter-menu li a {
  text-decoration: none;
  padding: 0em 1em;
  display: block;
}
.shop-section .categories-header-section {
  border-bottom: 1px solid #ebebeb;
  padding: 7px 15px 15px;
}
.shop-section .categories-header-section .reset,
.shop-section .categories-header-section .close-menu {
  text-transform: lowercase;
  float: right;
  border-bottom: 1px solid gray;
  cursor: pointer;
}
.shop-section .menus-categories-filters-section .son-filter-block {
  cursor: pointer;
  margin-top: 5px;
  padding: 10px 0px 10px 20px;
}
.shop-section .menus-categories-filters-section .son-filter-block:hover {
  background-color: #fbf6f6;
}
.shop-section .menus-categories-filters-section .son-filter-block .shop-filter-icon-holder {
  display: inline-block;
  /* padding: 0px 2px; */
  border: 1px solid #585555;
  /* border-radius: 5px; */
  height: 20px;
  width: 20px;
  /* padding: 0px 0px 4px 3px; */
  display: inline-block;
  justify-content: center;
  align-items: center;
}
.shop-section .menus-categories-filters-section .son-filter-block .shop-filter-icon-holder i {
  font-size: 10px;
  position: relative;
  left: 4px;
  top: -4px;
}
.shop-section .menus-categories-filters-section .son-filter-block .shop-filter-icon-holder i.color {
  color: white !important;
}
.shop-section .menus-categories-filters-section .son-filter-block .color-icon-holder {
  border: none;
}
.shop-section .menus-categories-filters-section .son-filter-block .name, .shop-section .menus-categories-filters-section .son-filter-block .product-content .price, .product-content .shop-section .menus-categories-filters-section .son-filter-block .price,
.shop-section .menus-categories-filters-section .son-filter-block .items {
  display: inline-block;
  margin-left: 10px;
}
.shop-section .menus-categories-filters-section .son-filter-block .items {
  margin-left: 0px;
}
.shop-section .menus-categories-filters-section .son-filter-block .hidden-category-id {
  visibility: hidden;
}
.shop-section .price-section {
  padding: 10px;
}
.shop-section .price-section .min,
.shop-section .price-section .max {
  width: 50%;
  padding: 10px 0px 10px 10px;
  float: left;
}
.shop-section .price-section .min .head,
.shop-section .price-section .max .head {
  margin-left: 5px;
}
.shop-section .price-section .min input,
.shop-section .price-section .max input {
  margin-top: 4px;
  width: 100%;
  display: inline-block;
}
@media (max-width: 600px) {
  .shop-section .shop-colors-menu, .shop-section .shop-sizes-menu {
    right: 0px !important;
  }
  .shop-section ul.shop-filter-menu {
    width: 220px;
  }
  .shop-section .shop-filter-icon-holder i.color {
    top: -2px !important;
  }
}
@media (max-width: 433px) {
  .shop-section .filter-right-section .sort-by .filter-header {
    display: block !important;
  }
  .shop-section .filter-right-section .sort-by .sort-select {
    margin-left: 0px !important;
  }
}
.shop-section .products-content-holder {
  min-height: 380px !important;
}
.shop-section .products-content-holder .shop-products-section {
  flex: 0 0 100%;
  max-width: 0 0 100%;
  transition: 0.3s all ease-in-out;
}
.shop-section .products-content-holder .shop-products-section .product-block {
  position: relative;
  flex: 0 0 calc(25% - 20px);
  flex: 0 0 calc(25% - 20px);
  margin: 0px 10px 40px;
}
.shop-section .products-content-holder .shop-products-section .product-block a:hover {
  text-decoration: none !important;
}
.shop-section .products-content-holder .shop-products-section .product-block img {
  width: 100%;
}
.shop-section .products-content-holder .shop-products-section .product-block .product-content-holder {
  padding: 10px;
}
.shop-section .products-content-holder .shop-products-section .product-block .product-content-holder .shop-category-name {
  display: inline-block;
}
.shop-section .products-content-holder .shop-products-section .add-transation {
  transition: 1s ease all;
}
.shop-section .products-content-holder .shop-products-section .add-transation::after {
  content: "";
  display: block;
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  width: 100%;
  height: 100%;
  background: rgb(255, 255, 255);
  opacity: 0.5;
  z-index: 99 !important;
}
@media (max-width: 1200px) {
  .shop-section .products-content-holder .shop-products-section {
    padding: 0px 10px;
  }
  .shop-section .products-content-holder .shop-products-section .product-block {
    flex: 0 0 calc(33.33% - 20px);
    max-width: 0 0 calc(33.33% - 20px);
    margin: 0px 10px 40px;
  }
}
@media (max-width: 768px) {
  .shop-section .products-content-holder .shop-products-section {
    padding: 0px 10px;
  }
  .shop-section .products-content-holder .shop-products-section .product-block {
    flex: 0 0 calc(50% - 20px);
    flex: 0 0 calc(50% - 20px);
  }
}
.shop-section .products-content-holder .shop-products-section a:hover {
  text-decoration: none !important;
}
.shop-section .products-content-holder .filter-results-holder {
  min-height: 380px;
  text-align: left;
  padding: 20px 10px 20px 15px;
}
.shop-section .products-content-holder .filter-results-holder .shop-report-filter-header:nth-child(1), .shop-section .products-content-holder .filter-results-holder .filter-section .filter-left-section .filters-keys-menus .filter-header:nth-child(1), .shop-section .filter-section .filter-left-section .filters-keys-menus .products-content-holder .filter-results-holder .filter-header:nth-child(1), .shop-section .products-content-holder .filter-results-holder .filter-section .filter-right-section .sort-by .filter-header:nth-child(1), .shop-section .filter-section .filter-right-section .sort-by .products-content-holder .filter-results-holder .filter-header:nth-child(1) {
  margin-top: 10px;
}
.shop-section .products-content-holder .filter-results-holder .shop-report-filter-header:nth-child(2), .shop-section .products-content-holder .filter-results-holder .filter-section .filter-left-section .filters-keys-menus .filter-header:nth-child(2), .shop-section .filter-section .filter-left-section .filters-keys-menus .products-content-holder .filter-results-holder .filter-header:nth-child(2), .shop-section .products-content-holder .filter-results-holder .filter-section .filter-right-section .sort-by .filter-header:nth-child(2), .shop-section .filter-section .filter-right-section .sort-by .products-content-holder .filter-results-holder .filter-header:nth-child(2) {
  margin-top: 5px;
}
.shop-section .products-content-holder .hide {
  transition: 0.3s all ease-in;
  opacity: 0;
}
.shop-section .pagination-section {
  position: relative;
  padding-top: 30px;
  display: flex;
  justify-content: center;
}
.shop-section .pagination-section .active-link, .shop-section .pagination-section #pagination_prev_link:hover,
.shop-section .pagination-section #pagination_next_link:hover, .shop-section .pagination-section #pagination_pages_links .active a, .shop-section .pagination-section #pagination_pages_links li:hover a {
  background-color: #3a3636;
  transition: 0.2s all ease;
  text-decoration: none !important;
}
.shop-section .pagination-section #pagination_pages_links {
  list-style: none;
  display: inline-block;
}
.shop-section .pagination-section #pagination_pages_links li {
  float: left;
}
.shop-section .pagination-section a {
  background: #d2d2d2;
  height: 25px;
  width: 25px;
  display: inline-block;
  margin: 0px 5px;
  color: white;
  text-align: center !important;
}
.shop-section .pagination-section a:hover {
  color: white !important;
}
.shop-section .pagination-section .disabled {
  opacity: 0.4;
}
.shop-section .pagination-section .disabled:hover {
  background-color: #d2d2d2 !important;
  cursor: text;
}

.product-details-section {
  padding: 50px 20px 0px;
}
.product-details-section .deals-section {
  padding: 70px 0px !important;
}
.product-details-section .deals-section a {
  text-decoration: none !important;
}
.product-details-section .deals-section .deals-owl-carousel {
  margin-top: 20px;
}
.product-details-section .deals-section .deals-owl-carousel .owl-dots {
  display: none;
}
.product-details-section .deals-section .deals-owl-carousel .owl-nav {
  display: none !important;
}
.product-details-section .deals-section .text {
  margin-top: 10px;
  margin-bottom: 5px;
}
.product-details-section .deals-section .mega-header, .product-details-section .deals-section .header, .product-details-section .deals-section .links-header {
  text-align: left;
  padding-left: 20px;
}
@media (max-width: 768px) {
  .product-details-section .deals-section {
    padding-top: 20px !important;
  }
}
.product-details-section .images-section {
  width: 50%;
  display: inline-block;
  position: relative;
}
.product-details-section .images-section .wishlist {
  display: inline-block;
  position: absolute;
  z-index: 9;
  top: 20px;
  padding: 5px 10px 6px;
  right: 20px;
  background: white;
  border-radius: 50%;
  cursor: pointer;
  opacity: 0.8;
  transition: 0.3s all ease;
}
.product-details-section .images-section .wishlist:hover {
  opacity: 1;
}
.product-details-section .images-section .wishlist img {
  width: 14px;
}
.product-details-section .images-section #product_details_preview_image_slider .owl-dots {
  display: none;
}
.product-details-section .images-section #product_details_preview_image_slider .zomm-image {
  cursor: zoom-in;
}
.product-details-section .images-section #product_details_thumb_image_slider .item {
  margin-top: 15px;
  cursor: pointer;
  border: 3px solid transparent;
  transition: 0.3s all ease;
}
.product-details-section .images-section #product_details_thumb_image_slider .item:hover {
  border: 3px solid gold;
}
.product-details-section .images-section #product_details_thumb_image_slider .current .item {
  border: 3px solid gold;
}
.product-details-section .images-section #product_details_thumb_image_slider .owl-nav {
  margin-top: 0px !important;
}
.product-details-section .images-section #product_details_thumb_image_slider .owl-nav button {
  position: absolute;
  top: calc(50% - 20px);
  background: white;
  padding: 8px 6px 10px !important;
  border-radius: 0% !important;
  opacity: 0.8;
  transition: 0.2s all ease;
  margin: 0px !important;
}
.product-details-section .images-section #product_details_thumb_image_slider .owl-nav button i {
  color: #3a3636 !important;
  font-size: 12px !important;
}
.product-details-section .images-section #product_details_thumb_image_slider .owl-nav button:nth-child(1) {
  left: 0px;
}
.product-details-section .images-section #product_details_thumb_image_slider .owl-nav button:nth-child(2) {
  right: 0px;
}
.product-details-section .images-section #product_details_thumb_image_slider .owl-nav button:hover {
  opacity: 1;
}
.product-details-section .images-section #product_details_thumb_image_slider .owl-nav svg {
  width: 8px !important;
}
.product-details-section .images-section .zoom {
  display: inline-block;
  position: relative;
}
.product-details-section .images-section .zoom img {
  display: block;
}
@media (max-width: 768px) {
  .product-details-section .images-section {
    width: 100%;
    max-width: 600px;
  }
}
.product-details-section .collapsing {
  transition: none !important;
}
.product-details-section .informations-section {
  width: 50%;
  float: right;
  padding-left: 50px;
}
.product-details-section .informations-section .sku {
  font-size: 12px;
  color: darkgray;
  text-transform: uppercase;
}
.product-details-section .informations-section .category {
  margin-top: 5px;
}
.product-details-section .informations-section .category a {
  color: #3a3636 !important;
  text-decoration: underline;
  font-size: 13px;
}
.product-details-section .informations-section .category a:hover {
  color: #3a3636 !important;
}
.product-details-section .informations-section .price {
  margin-top: 10px;
}
.product-details-section .informations-section .options .colors .head {
  color: #3a3636;
  font-size: 13px;
  text-transform: capitalize;
}
.product-details-section .informations-section .options .colors .color-blocks-holder {
  padding: 10px;
}
.product-details-section .informations-section .options .colors .color-blocks-holder .holder {
  cursor: pointer;
  transition: 0.3s all ease;
  display: inline-block;
  border-radius: 50%;
  padding: 2px;
  margin-right: 5px;
  margin-top: 5px;
  border: 1px solid white;
}
.product-details-section .informations-section .options .colors .color-blocks-holder .holder .color-block {
  height: 22px;
  width: 22px;
  border-radius: 50%;
}
.product-details-section .informations-section .options .colors .color-blocks-holder .disabled {
  opacity: 0.6;
  cursor: text !important;
}
.product-details-section .informations-section .options .colors .color-blocks-holder .disabled .strock {
  height: 1px;
  background-color: #e9e9ed;
  padding: 1px;
  transform: rotate(45deg);
  width: 97%;
  position: relative;
  top: 50%;
  left: 5%;
}
.product-details-section .informations-section .options .colors .color-blocks-holder .active, .product-details-section .informations-section .options .colors .color-blocks-holder .shop-section .pagination-section #pagination_pages_links li:hover, .shop-section .pagination-section #pagination_pages_links .product-details-section .informations-section .options .colors .color-blocks-holder li:hover {
  border: 1px solid rgb(218, 34, 34);
}
.product-details-section .informations-section .options .sizes .head {
  color: #3a3636;
  font-size: 13px;
  text-transform: capitalize;
}
.product-details-section .informations-section .options .sizes .size-blocks-holder {
  padding: 10px;
}
.product-details-section .informations-section .options .sizes .size-blocks-holder .holder {
  position: relative;
  cursor: pointer;
  transition: 0.3s all ease;
  display: inline-block;
  margin-right: 5px;
  margin-top: 5px;
  border: 1px solid gray;
}
.product-details-section .informations-section .options .sizes .size-blocks-holder .holder .size-block {
  padding: 4px 8px;
  font-size: 13px;
}
.product-details-section .informations-section .options .sizes .disabled {
  opacity: 0.6;
  cursor: text !important;
}
.product-details-section .informations-section .options .sizes .disabled .strock {
  height: 1px;
  background-color: #3a3636;
  position: absolute;
  transform: rotate(45deg);
  width: 97%;
  top: 50%;
  left: 5%;
}
.product-details-section .informations-section .options .sizes .active, .product-details-section .informations-section .options .sizes .shop-section .pagination-section #pagination_pages_links li:hover, .shop-section .pagination-section #pagination_pages_links .product-details-section .informations-section .options .sizes li:hover {
  border-color: rgb(218, 34, 34) !important;
}
.product-details-section .informations-section .options .sizes .active .size-block, .product-details-section .informations-section .options .sizes .shop-section .pagination-section #pagination_pages_links li:hover .size-block, .shop-section .pagination-section #pagination_pages_links .product-details-section .informations-section .options .sizes li:hover .size-block {
  color: rgb(218, 34, 34) !important;
}
.product-details-section .informations-section .options .sizes .size-guide {
  margin: 10px 0px;
}
.product-details-section .informations-section .options .sizes .size-guide a {
  margin-right: 5px;
  color: #3a3636 !important;
  text-decoration: underline;
  font-size: 13px;
}
.product-details-section .informations-section .options .sizes .size-guide a:hover {
  color: #3a3636 !important;
}
.product-details-section .informations-section .options .key {
  display: none;
}
.product-details-section .informations-section .availability-report .holder {
  display: none;
  margin: 20px 0px 20px;
}
.product-details-section .informations-section .availability-report .holder button {
  color: #585555;
  border-color: #585555;
  background-color: white;
  cursor: text;
}
.product-details-section .informations-section .availability-report .holder button:hover {
  color: #ffafaf;
  border: 1px solid #ffafaf;
}
.product-details-section .informations-section .availability-report .active, .product-details-section .informations-section .availability-report .shop-section .pagination-section #pagination_pages_links li:hover, .shop-section .pagination-section #pagination_pages_links .product-details-section .informations-section .availability-report li:hover {
  display: block;
}
.product-details-section .informations-section .cart {
  margin: 20px 0px 20px;
}
.product-details-section .informations-section .share {
  font-size: 13px;
  font-weight: 500;
  color: #3a3636;
  margin: 30px 0px 0px;
  text-transform: capitalize;
}
.product-details-section .informations-section .share i {
  color: #3a3636;
  font-size: 18px;
}
.product-details-section .informations-section .product-details-accordion {
  margin-top: 30px;
}
.product-details-section .informations-section .product-details-accordion .accordion-item {
  padding: 20px 0px;
  border-top: 1px solid #e5e5e5;
}
.product-details-section .informations-section .product-details-accordion .accordion-item .accordion-header {
  font-size: 14px;
  margin-bottom: 10px;
  font-weight: 500;
  color: #3a3636;
}
.product-details-section .informations-section .product-details-accordion .accordion-item .accordion-header i {
  float: right;
  padding-right: 20px;
}
.product-details-section .informations-section .product-details-accordion .accordion-item .accordion-body .care, .product-details-section .informations-section .product-details-accordion .accordion-item .accordion-body .measurements-size {
  font-size: 13px;
  font-weight: 500;
  color: #3a3636;
  margin: 10px 0px;
}
.product-details-section .informations-section .product-details-accordion .accordion-item .accordion-body .measurements-size ul {
  padding-left: 20px;
  margin-top: 5px;
}
.product-details-section .informations-section .product-details-accordion .accordion-item .accordion-body .measurements-size ul li {
  margin-top: 5px;
}
.product-details-section .informations-section .product-details-accordion .accordion-item .accordion-body .contents-ul {
  padding-left: 20px;
}
.product-details-section .informations-section .product-details-accordion .main-color {
  color: #ffafaf;
}
.product-details-section .informations-section .product-details-accordion .accordion-item:last-of-type {
  border-bottom: 1px solid #e5e5e5;
}
@media (max-width: 768px) {
  .product-details-section .informations-section {
    width: 100%;
    padding: 30px 0px;
  }
}
.product-details-section #sizeGuideModel {
  padding-right: 0px !important;
}
.product-details-section #sizeGuideModel .modal-header .name, .product-details-section #sizeGuideModel .modal-header .product-content .price, .product-content .product-details-section #sizeGuideModel .modal-header .price {
  font-weight: 400 !important;
}
.product-details-section #sizeGuideModel .modal-header .report {
  color: #3a3636 !important;
  font-size: 13px;
  margin-top: 5px;
}
.product-details-section #sizeGuideModel .modal-header .report:hover {
  color: #3a3636 !important;
}
.product-details-section #sizeGuideModel .switches {
  text-align: center;
  padding: 20px 0px;
}
.product-details-section #sizeGuideModel .switches span {
  cursor: pointer;
  border: 1px solid #c5c4c4;
  margin-right: 10px;
  padding: 4px 15px 7px;
}
.product-details-section #sizeGuideModel .switches span i {
  font-size: 10px !important;
}
.product-details-section #sizeGuideModel .switches span:hover {
  border: 1px solid #3a3636;
}
.product-details-section #sizeGuideModel .switches .active, .product-details-section #sizeGuideModel .switches .shop-section .pagination-section #pagination_pages_links li:hover, .shop-section .pagination-section #pagination_pages_links .product-details-section #sizeGuideModel .switches li:hover {
  border: 1px solid #3a3636;
}
.product-details-section #sizeGuideModel img {
  max-width: 100%;
}
.product-details-section #sizeGuideModel .size-guide {
  padding: 20px;
  font-family: Arial, Helvetica, sans-serif;
  line-height: 1.6em;
}
.product-details-section #sizeGuideModel .title-wrap {
  margin-bottom: 20px;
}
.product-details-section #sizeGuideModel .title-wrap h2 {
  margin-bottom: 0;
}
.product-details-section #sizeGuideModel table {
  border: 1px solid #ebebeb;
}
.product-details-section #sizeGuideModel .title-wrap .title-tip {
  font-size: 0.8em;
  color: #3a3636;
}
.product-details-section #sizeGuideModel .table-responsive,
.product-details-section #sizeGuideModel .title-wrap {
  text-align: center;
}
.product-details-section #sizeGuideModel .size-guide-table {
  border-spacing: 0;
  text-align: left;
}
.product-details-section #sizeGuideModel .size-guide-table th[scope=col] {
  white-space: pre;
  word-wrap: nowrap;
}
.product-details-section #sizeGuideModel .size-guide-table th[scope=col],
.product-details-section #sizeGuideModel .size-guide-table td {
  min-width: 100px;
}
.product-details-section #sizeGuideModel .size-guide-table th,
.product-details-section #sizeGuideModel .size-guide-table td {
  padding: 10px 20px;
}
.product-details-section #sizeGuideModel .size-guide-table th[scope=row] {
  min-width: 50px;
}
.product-details-section #sizeGuideModel .size-guide-table tr:nth-child(2n) td,
.product-details-section #sizeGuideModel .size-guide-table tr:nth-child(2n) th {
  background-color: #eee;
}
.product-details-section #sizeGuideModel .size-guide-table thead th {
  background-color: #ffafaf;
  padding: 7px 10px;
  font-size: 14px !important;
  color: #fff;
  text-align: center;
  font-weight: 400;
  letter-spacing: 1px;
}
.product-details-section #sizeGuideModel .size-guide-table th, .product-details-section #sizeGuideModel .product-details-section #sizeGuideModel .size-guide-table td {
  padding: 10px 7px;
  text-align: center;
}
.product-details-section #sizeGuideModel .size-guide-table td {
  padding: 10px 7px;
  text-align: center;
  color: #3a3636;
}
.product-details-section #sizeGuideModel .guide-informations-list {
  padding: 0px 20px;
  margin-top: 40px;
  display: flex;
  justify-content: center;
}
.product-details-section #sizeGuideModel .guide-informations-list li {
  margin-bottom: 5px;
}
@media (min-width: 768px) {
  .product-details-section #sizeGuideModel .modal-dialog {
    max-width: 700px;
    margin: 1.75rem auto;
  }
}
@media (max-width: 768px) {
  .product-details-section #sizeGuideModel .size-guide {
    padding: 0px;
  }
}
@media (max-width: 768px) {
  .product-details-section {
    padding: 20px 20px 0px !important;
  }
}

</style>
</head>

<body>
    <!-- get all categories for navbar -->
    <?php
    use App\Models\Category;
    $categories = Category::where('status', '!=', 0)->get();
    ?>
    <!-- get all categories for navbar -->
    <div id="app">
        <div id="main_content">

            <div class="preloader" id="preloader">
                <div class="loader-holder">
                    <div class="loader3">
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>

            @if (session()->has('message'))
                <div class=" alert alert-success alert-dismissible fade show success-alert" role="alert">
                    <div class="fluid-container">
                        {{ session()->get('message') }} <button type="button" class="close"
                            data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif

            @if (session('status'))
                <div class=" alert alert-success alert-dismissible fade show success-alert" role="alert">
                    <div class="fluid-container">


                        {{ session('status') }} <button type="button" class="close" data-dismiss="alert"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> </div>
                </div>
            @endif

            @include('components.navbar.main')
            <main>
                @yield('content')
            </main>
        </div>

        @include('components.footer.main')
    </div>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery-1.10.1.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-zoom/1.7.20/jquery.zoom.min.js"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript">
        let shopDataObject = {
            products: {!! json_encode(isset($products) ? $products : []) !!},
            categories: {!! json_encode(isset($categories) ? $categories : []) !!},
            shopFilter: {
                filteredProducts: {!! json_encode(isset($products) ? $products : []) !!},
                activeCategoryName: null,
                activeCategory: {},
                activeColorsNames: [],
                activeSizesNames: [],
                offer: null,
                type: null,
                name: null,
                minPrice: null,
                maxPrice: null,
                filterValuesArray: [],
                max_price: {!! json_encode(isset($max_price) ? $max_price : null) !!}
            }

        }

        // define the filter variable
        let minPrice = shopDataObject.shopFilter.minPrice;
        let maxPrice = shopDataObject.shopFilter.maxPrice;
        let products = shopDataObject.products;
        let categories = shopDataObject.categories;
        let filteredProducts = shopDataObject.shopFilter.filteredProducts;
        let filterValuesArray = shopDataObject.shopFilter.filterValuesArray;
        let activeCategoryName = shopDataObject.shopFilter.activeCategoryName;
        let activeCategory = shopDataObject.shopFilter.activeCategory;
        let activeSizesNames = shopDataObject.shopFilter.activeSizesNames;
        let activeColorsNames = shopDataObject.shopFilter.activeColorsNames;
        let name = shopDataObject.shopFilter.name;
        let offer = shopDataObject.shopFilter.offer;
        let type = shopDataObject.shopFilter.type;
        let shopPaginationItemsPerPage = 12;
        let shopPaginationCurrentPage = 1;
        let max_price = shopDataObject.shopFilter.max_price
        // define the filter variable

        // convert data in products to use sort filter
        shopDataObject.shopFilter.filteredProducts.forEach(item => {
            item.updated_at = new Date(item.updated_at)
        })
        // convert data in products to use sort filter

        // // product details section 
        let productDetailsDataObject = {
            productDetailsImagesSliders: {!! json_encode(isset($productDetailsImagesSliders) ? $productDetailsImagesSliders : []) !!},
            filteredProductDetailsImagesSliders: {!! json_encode(isset($productDetailsImagesSliders) ? $productDetailsImagesSliders : []) !!},
            variations: {!! json_encode(isset($variations) ? $variations : []) !!},
            sizeGuides: {!! json_encode(isset($sizeGuides) ? $sizeGuides : []) !!},
            sizeGuideType: 'cm',
            filteredVariations: {!! json_encode(isset($variations) ? $variations : []) !!},
            activeVariation: {},
            colors: {!! json_encode(isset($colors) ? $colors : []) !!},
            sizes: {!! json_encode(isset($sizes) ? $sizes : []) !!},
            filter: {
                status: false,
                activeSize: {},
                activeColor: {},

            }
        }

        let variations = productDetailsDataObject.variations;
        let sizeGuides = productDetailsDataObject.sizeGuides;
        let sizeGuideType = productDetailsDataObject.sizeGuideType;



        let filteredProductDetailsImagesSliders = productDetailsDataObject.filteredProductDetailsImagesSliders;
        let productDetailsImagesSliders = productDetailsDataObject.productDetailsImagesSliders;


        let filteredVariations = productDetailsDataObject.filteredVariations;

        let activeVariation = productDetailsDataObject.activeVariation;

        let colors = productDetailsDataObject.colors;

        let sizes = productDetailsDataObject.sizes;

        let activeSize = productDetailsDataObject.filter.activeSize;

        let activeColor = productDetailsDataObject.filter.activeColor;






        // // product details section 


        let shopPaginationPagesLinksNumber = shopPaginationReturnPagesLinksNumber();

        function shopPaginationReturnPagesLinksNumber() {
            // returns the number of pages
            return Math.ceil(filteredProducts.length / shopPaginationItemsPerPage);
        }




        function shopPaginationAddPagesLinks() {
            // grab reference to containing element

            let el = document.getElementById("pagination_pages_links");
            let pagesLinksData = ``;
            // for each page



            for (let i = 1; i < Math.ceil(filteredProducts.length / shopPaginationItemsPerPage) + 1; i++) {
                // append a link with the respective page number


                pagesLinksData += `<li class = "${
                i == 1 ? "active" : ""
            }"><a  href="javascript:shopPaginationgoToPageLink(${i})">${i}</a></li>`;
            }

            el.innerHTML = filteredProducts.length > 12 ? pagesLinksData : ``;



        }

        let timer = window.location.pathname.trim() == '/shop' ? 1000 : 300;

        setTimeout(hideLoader, timer);

        function hideLoader() {
            document.getElementById('preloader').classList.add('d-none')
        }
    </script>
    <!-- custom js files  -->
    <script src="{{ asset('js/custom/designing.js') }}"></script>
    <script src="{{ asset('js/custom/filter-functions.js') }}"></script>
    <script src="{{ asset('js/custom/queries-filter.js') }}"></script>
    <script src="{{ asset('js/custom/pagination.js') }}"></script>
    <script src="{{ asset('js/custom/event-filter.js') }}"></script> 
    <!-- custom js files  

</body>

</html>
