<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>House Points Leaderboard - TV Display</title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800;900&display=swap"
        rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #020202;
            color: #fff;
            height: 100vh;
            overflow: hidden;
            user-select: none;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image:
                radial-gradient(ellipse at 50% 0%, rgba(212, 175, 55, 0.08) 0%, transparent 60%),
                radial-gradient(ellipse at 80% 20%, rgba(47, 9, 215, 0.06) 0%, transparent 50%),
                radial-gradient(ellipse at 20% 80%, rgba(245, 158, 11, 0.06) 0%, transparent 50%);
        }

        .stars {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
            background: transparent;
        }

        .star {
            position: absolute;
            background: white;
            border-radius: 50%;
            opacity: 0;
            animation: twinkle 4s infinite ease-in-out;
        }

        @keyframes twinkle {

            0%,
            100% {
                opacity: 0.2;
                transform: scale(0.8);
            }

            50% {
                opacity: 1;
                transform: scale(1.2);
            }
        }

        .leaderboard-container {
            position: relative;
            z-index: 1;
            width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 2rem 3rem;
        }

        .title-section {
            text-align: center;
            margin-bottom: 2.2rem;
            flex-shrink: 0;
        }

        .title-section h1 {
            font-family: 'Playfair Display', serif;
            font-weight: 900;
            font-size: 4rem;
            letter-spacing: 0.05em;
            background: linear-gradient(135deg, #f9e076 0%, #d4af37 40%, #b49450 80%, #f9e076 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-transform: uppercase;
            margin-bottom: 0.3rem;
            filter: drop-shadow(0 4px 12px rgba(212, 175, 55, 0.4));
        }

        .title-section .subtitle {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.55);
            letter-spacing: 0.4em;
            font-weight: 500;
            text-transform: uppercase;
            margin-top: 0.2rem;
        }

        .houses-row {
            flex: 1;
            display: flex;
            gap: 2rem;
            align-items: flex-end;
            justify-content: center;
        }

        .house-column {
            flex: 1;
            display: flex;
            flex-direction: column;
            height: 100%;
            max-width: 300px;
            align-items: center;
            transition: transform 0.3s ease;
        }

        .house-column:hover {
            transform: translateY(-5px);
        }

        .house-name-label {
            text-align: center;
            font-weight: 700;
            font-size: 1.2rem;
            letter-spacing: 0.15em;
            color: rgba(255, 255, 255, 0.85);
            text-transform: uppercase;
            margin-bottom: 0.3rem;
            flex-shrink: 0;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.7);
        }

        /* Rank badge styles */
        .house-rank-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2.5rem;
            height: 2.5rem;
            margin-bottom: 0.5rem;
            border-radius: 50%;
            font-weight: 700;
            font-size: 1.1rem;
            color: #fff;
            border: 2px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
            flex-shrink: 0;
            backdrop-filter: blur(10px);
            position: relative;
            overflow: hidden;
        }

        /* Rank 1 badge – golden pulsating glow */
        .rank-1-badge {
            background: rgba(255, 215, 0, 0.25);
            border-color: #f9e076;
            box-shadow: 0 0 20px rgba(255, 215, 0, 0.6), 0 0 40px rgba(255, 215, 0, 0.3);
            animation: rank1Pulse 2.5s infinite ease-in-out;
        }

        .rank-1-badge::after {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 50%;
            background: transparent;
            border: 2px solid rgba(255, 215, 0, 0.8);
            animation: rank1Ring 2.5s infinite ease-in-out;
        }

        @keyframes rank1Pulse {

            0%,
            100% {
                transform: scale(1);
                box-shadow: 0 0 20px rgba(255, 215, 0, 0.6), 0 0 40px rgba(255, 215, 0, 0.3);
            }

            50% {
                transform: scale(1.05);
                box-shadow: 0 0 30px rgba(255, 215, 0, 0.9), 0 0 60px rgba(255, 215, 0, 0.5);
            }
        }

        @keyframes rank1Ring {

            0%,
            100% {
                transform: scale(1);
                opacity: 0.8;
            }

            50% {
                transform: scale(1.15);
                opacity: 0.3;
            }
        }

        /* Rank 2,3,4 badges – subtle shimmer border */
        .rank-other-badge {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.3);
            animation: otherRankGlow 3s infinite ease-in-out;
        }

        .rank-other-badge::after {
            content: '';
            position: absolute;
            top: -2px;
            left: -100%;
            width: 300%;
            height: calc(100% + 4px);
            background: linear-gradient(90deg,
                    transparent 0%,
                    rgba(255, 255, 255, 0.15) 50%,
                    transparent 100%);
            animation: otherShimmer 3.5s infinite linear;
        }

        @keyframes otherRankGlow {

            0%,
            100% {
                box-shadow: 0 0 8px rgba(255, 255, 255, 0.2);
            }

            50% {
                box-shadow: 0 0 15px rgba(255, 255, 255, 0.4);
            }
        }

        @keyframes otherShimmer {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(100%);
            }
        }

        .bar-wrapper {
            flex: 1;
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }

        .bar {
            width: 100%;
            border-radius: 24px 24px 0 0;
            background: linear-gradient(180deg, rgba(20, 20, 20, 0.95) 0%, rgba(5, 5, 5, 0.98) 100%);
            transition: height 1.8s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow:
                0 -8px 30px rgba(255, 255, 255, 0.08),
                inset 0 1px 0 rgba(255, 255, 255, 0.05);
            border-top: 4px solid rgba(255, 255, 255, 0.3);
            overflow: hidden;
            transform-origin: bottom;
            backdrop-filter: blur(5px);
            height: 0;
        }

        .lions .bar {
            border-top-color: #f59e0b;
            box-shadow: 0 -8px 35px rgba(245, 158, 11, 0.65), inset 0 1px 0 rgba(255, 255, 255, 0.06);
        }

        .horses .bar {
            border-top-color: #22a133;
            box-shadow: 0 -8px 35px rgba(34, 161, 51, 0.65), inset 0 1px 0 rgba(255, 255, 255, 0.06);
        }

        .wolves .bar {
            border-top-color: #970707;
            box-shadow: 0 -8px 35px rgba(151, 7, 7, 0.65), inset 0 1px 0 rgba(255, 255, 255, 0.06);
        }

        .eagles .bar {
            border-top-color: #2f09d7;
            box-shadow: 0 -8px 35px rgba(47, 9, 215, 0.65), inset 0 1px 0 rgba(255, 255, 255, 0.06);
        }

        /* General inner glow for all bars – smooth pulsating light */
        .bar::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: inherit;
            background: radial-gradient(circle at 50% 80%, rgba(255, 255, 255, 0.15) 0%, transparent 70%);
            animation: innerGlowPulse 3s infinite ease-in-out;
        }

        @keyframes innerGlowPulse {

            0%,
            100% {
                opacity: 0.2;
            }

            50% {
                opacity: 0.5;
            }
        }

        /* Special smooth glowing animation for Wolves house */
        .wolves .bar::after {
            background: radial-gradient(circle at 50% 80%, rgba(255, 70, 70, 0.4) 0%, transparent 70%);
            animation: wolvesSmoothGlow 2.8s infinite ease-in-out;
        }

        @keyframes wolvesSmoothGlow {

            0%,
            100% {
                opacity: 0.25;
                transform: scale(1);
            }

            50% {
                opacity: 0.65;
                transform: scale(1.02);
            }
        }

        /* Golden shimmer for rank 1 (also wolves) – separate from glow */
        .bar.rank-1-bar::before {
            content: '';
            position: absolute;
            top: 0;
            left: -50%;
            width: 200%;
            height: 100%;
            background: linear-gradient(90deg,
                    transparent 0%,
                    rgba(255, 215, 0, 0.15) 40%,
                    rgba(255, 215, 0, 0.25) 50%,
                    rgba(255, 215, 0, 0.15) 60%,
                    transparent 100%);
            animation: shimmer 3.5s infinite linear;
            z-index: 1;
            opacity: 0;
            animation: shimmer 3.5s 1s infinite linear, shimmerFadeIn 1s 1s forwards ease-out;
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-50%);
            }

            100% {
                transform: translateX(50%);
            }
        }

        @keyframes shimmerFadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        .bar-content {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            z-index: 2;
        }

        .bar-emoji {
            font-size: 5.8rem;
            filter: drop-shadow(0 0 35px rgba(255, 255, 255, 0.6));
            margin-bottom: 0.6rem;
            line-height: 1;
            opacity: 0;
            transform: translateY(20px) scale(0.8);
            animation: emojiReveal 1.2s 0.5s forwards cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes emojiReveal {
            0% {
                opacity: 0;
                transform: translateY(20px) scale(0.8);
            }

            60% {
                opacity: 1;
                transform: translateY(-5px) scale(1.05);
            }

            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .bar-points {
            font-weight: 900;
            font-size: 2.7rem;
            color: #ffffff;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.9), 0 0 15px currentColor;
            letter-spacing: 0.05em;
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(8px);
            padding: 0.2rem 1.2rem;
            border-radius: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            opacity: 0;
            animation: pointsReveal 0.8s 1s forwards ease-out;
        }

        @keyframes pointsReveal {
            0% {
                opacity: 0;
                transform: translateY(10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 1200px) {
            .houses-row {
                gap: 1.2rem;
            }

            .house-column {
                max-width: 240px;
            }

            .bar-emoji {
                font-size: 4.2rem;
            }

            .bar-points {
                font-size: 2rem;
            }

            .title-section h1 {
                font-size: 3rem;
            }

            .house-rank-badge {
                width: 2.2rem;
                height: 2.2rem;
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    <!-- Starfield background -->
    <div class="stars" id="starsContainer"></div>

    <div class="leaderboard-container">
        <div class="title-section">
            <h1>🏆 House Leaderboard</h1>
            <div class="subtitle">Academic Year {{ $academicYears->name ?? 'N/A' }}</div>
            <input type="hidden" id="yearId" value="{{ $academicYears->id ?? 'null' }}">
        </div>
        <div class="houses-row" id="housesRow"></div>
    </div>

    <!-- Scripts -->
    <script src="/assets/plugins/jquery-3.7.1.min.js"></script>
    <script src="/assets/plugins/jquery.blockUI.js"></script>
    <script src="/assets/plugins/sweetalert.js"></script>
    <script src="/assets/app/app.js"></script>
    <script>
        const yearId = $('#yearId').val();
        const starsContainer = $('#starsContainer');
        let lastData = '';
        $(document).ready(function() {

            for (let i = 0; i < 80; i++) {
                const size = Math.random() * 3 + 1;
                const star = $('<div class="star"></div>').css({
                    width: size + 'px',
                    height: size + 'px',
                    top: Math.random() * 100 + '%',
                    left: Math.random() * 100 + '%',
                    animationDelay: Math.random() * 4 + 's',
                    animationDuration: (Math.random() * 3 + 3) + 's'
                });
                starsContainer.append(star);
            }
            getMembersByHouseIdAndYearId(yearId);
            setInterval(() => {
                getMembersByHouseIdAndYearId(yearId);
            }, 5000);
        });

        async function getMembersByHouseIdAndYearId(yearId) {
            try {
                const response = await ajaxRequest({
                    url: `/leaderboard/year/${yearId}`,
                    method: 'GET',
                });

                const newData = JSON.stringify(response);

                if (newData === lastData) {
                    return;
                }

                lastData = newData;

                let houses = await response;

                // Sort and assign ranks
                const sorted = [...houses].sort((a, b) => parseInt(b.total_points) - parseInt(a.total_points));
                const maxPoints = parseInt(sorted[0]?.total_points || 0);
                houses.forEach(house => {
                    house.rank = sorted.findIndex(h => h.name === house.name) + 1;
                });

                let html = '';
                houses.forEach(house => {
                    const rankBadgeClass = house.rank === 1 ? 'rank-1-badge' : 'rank-other-badge';
                    const barExtraClass = house.rank === 1 ? 'rank-1-bar' : '';
                    html += `
                    <div class="house-column ${house.name.toLowerCase()}">
                        <small><i>${house.total_points}</i></small>
                        <div class="house-name-label">${house.name}</div>
                        <div class="house-rank-badge ${rankBadgeClass}">#${house.rank}</div>
                        <div class="bar-wrapper">
                            <div class="bar ${barExtraClass}" data-points="${house.total_points}" style="height: 0%;">
                                <div class="bar-content">
                                    <div class="bar-emoji">🦁</div>
                                    <div class="bar-points" data-target="${house.total_points}">0</div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                });
                $('#housesRow').html(html);
                updateBarHeights(maxPoints);
                animateNumbers();

                setTimeout(() => {
                    updateBarHeights(maxPoints, true);
                    setTimeout(animateNumbers, 600);
                }, 300);

                $(window).on('resize', function() {
                    updateBarHeights(maxPoints, false);
                });

            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: error.message || 'Something went wrong'
                });
            }
        }
        // Smooth staggered rise
        function updateBarHeights(maxPoints, stagger = false) {
            const $bars = $('.bar');
            const maxHeightPercent = 100;
            const minHeightPercent = 10; // ensure bars are visible even when points = 0

            $bars.each(function(index) {
                const $bar = $(this);
                const points = parseInt($bar.data('points'));
                let percent;
                if (maxPoints === 0) {
                    percent = minHeightPercent + 10;
                } else {
                    percent = (points / maxPoints) * maxHeightPercent;
                    percent = Math.max(percent, minHeightPercent + 10);
                }

                if (stagger) {
                    setTimeout(() => {
                        $bar.css('height', percent + '%');
                    }, index * 250);
                } else {
                    $bar.css('height', percent + '%');
                }
            });
        }

        // Smooth count-up numbers
        function animateNumbers() {
            $('.bar-points').each(function(index) {
                const $el = $(this);
                const target = parseInt($el.data('target'));
                const duration = 2800;
                const startTime = Date.now();

                function update() {
                    const elapsed = Date.now() - startTime;
                    const progress = Math.min(elapsed / duration, 1);
                    const eased = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
                    const current = Math.floor(target * eased);
                    $el.text(current.toLocaleString());
                    if (progress < 1) {
                        requestAnimationFrame(update);
                    } else {
                        $el.text(target.toLocaleString());
                    }
                }
                setTimeout(() => {
                    requestAnimationFrame(update);
                }, index * 200 + 400);
            });
        }
    </script>
</body>

</html>
