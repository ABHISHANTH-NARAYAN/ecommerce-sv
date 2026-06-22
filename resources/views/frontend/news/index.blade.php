<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latest News | SV Distribution</title>

    <style>
        /* =========================================
           RESET & BASE STYLES
           ========================================= */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "SF Pro Display", sans-serif;
            background: 
                radial-gradient(circle at 20% 20%, rgba(0, 122, 255, 0.18), transparent 35%),
                radial-gradient(circle at 80% 30%, rgba(52, 199, 89, 0.15), transparent 35%),
                radial-gradient(circle at 50% 90%, rgba(175, 82, 222, 0.18), transparent 40%),
                #050816;
            color: #e5e7eb;
            min-height: 100vh;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            backdrop-filter: blur(120px);
            z-index: -1;
        }

        /* =========================================
           BACKGROUND EFFECTS
           ========================================= */
        .aurora {
            position: fixed;
            inset: 0;
            z-index: -1;
            background: 
                radial-gradient(circle at 20% 30%, rgba(59, 130, 246, 0.25), transparent 40%),
                radial-gradient(circle at 80% 20%, rgba(16, 185, 129, 0.20), transparent 40%),
                radial-gradient(circle at 50% 80%, rgba(168, 85, 247, 0.20), transparent 40%);
            animation: floatAurora 12s infinite alternate ease-in-out;
        }

        @keyframes floatAurora {
            from { transform: translateY(-20px); }
            to { transform: translateY(20px); }
        }

        .floating-orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(120px);
            z-index: -1;
        }

        .orb1 { width: 300px; height: 300px; background: #0ea5e9; top: 100px; left: -100px; }
        .orb2 { width: 350px; height: 350px; background: #34d399; right: -100px; top: 300px; }

        /* =========================================
           HERO & NAVIGATION
           ========================================= */
        .hero {
            text-align: center;
            padding: 80px 20px 20px;
        }

        .hero h1 {
            font-size: 56px;
            font-weight: 800;
            margin-bottom: 15px;
            background: linear-gradient(90deg, #ffffff, #60a5fa, #34d399);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 0 40px rgba(96, 165, 250, 0.3);
            letter-spacing: -1px;
        }

        .hero p {
            color: #94a3b8;
            font-size: 20px;
            max-width: 600px;
            margin: auto;
            line-height: 1.6;
        }

        .top-actions {
            text-align: center;
            margin-bottom: 50px;
        }

        .back-btn {
            display: inline-block;
            padding: 14px 28px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            color: white;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .back-btn:hover {
            transform: translateY(-3px);
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
            box-shadow: 0 15px 40px rgba(59, 130, 246, 0.2);
        }

        /* =========================================
           NEWS GRID
           ========================================= */
        .news-container {
            width: 92%;
            max-width: 1200px;
            margin: auto;
            padding-bottom: 80px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
            gap: 30px;
        }

        /* =========================================
           NEWS CARD (GLASSMORPHISM)
           ========================================= */
        .news-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 26px;
            overflow: hidden;
            transition: 0.4s ease;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
        }

        .news-card:hover {
            transform: translateY(-10px) scale(1.02);
            border-color: rgba(96, 165, 250, 0.4);
            box-shadow: 0 30px 60px rgba(59, 130, 246, 0.15);
            background: rgba(255, 255, 255, 0.05);
        }

        .news-card img {
            width: 100%;
            height: 240px;
            object-fit: cover;
            transition: 0.5s ease;
        }

        .news-card:hover img {
            transform: scale(1.05);
        }

        /* IMAGE WRAPPER (To hide overflow during image scale) */
        .img-wrapper {
            width: 100%;
            height: 240px;
            overflow: hidden;
        }

        .news-content {
            padding: 26px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .category {
            align-self: flex-start;
            background: rgba(59, 130, 246, 0.15);
            border: 1px solid rgba(59, 130, 246, 0.3);
            color: #60a5fa;
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .news-content h2 {
            font-size: 24px;
            margin-bottom: 12px;
            line-height: 1.3;
            color: #ffffff;
        }

        .news-content p {
            color: #94a3b8;
            line-height: 1.7;
            font-size: 15px;
            margin-bottom: 25px;
            flex-grow: 1;
        }

        .news-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        .date {
            color: #64748b;
            font-size: 13px;
            font-weight: 500;
        }

        .read-btn {
            background: linear-gradient(135deg, #0ea5e9, #34d399);
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            transition: 0.3s;
            border: none;
        }

        .read-btn:hover {
            filter: brightness(1.15);
            box-shadow: 0 8px 20px rgba(52, 211, 153, 0.3);
        }

        /* =========================================
           EMPTY STATE
           ========================================= */
        .empty {
            text-align: center;
            padding: 60px 20px;
            margin: 40px auto;
            max-width: 600px;
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 24px;
        }

        .empty h2 {
            color: #ffffff;
            margin-bottom: 10px;
            font-size: 28px;
        }

        .empty p {
            color: #94a3b8;
            font-size: 16px;
        }

        /* =========================================
           RESPONSIVE DESIGN
           ========================================= */
        @media(max-width: 768px) {
            .hero h1 {
                font-size: 42px;
            }
            .hero p {
                font-size: 16px;
            }
            .news-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <div class="aurora"></div>
    <div class="floating-orb orb1"></div>
    <div class="floating-orb orb2"></div>

    <div class="hero">
        <h1>📰 Latest News</h1>
        <p>Stay updated with our latest announcements, product launches, and company updates.</p>
    </div>

    <div class="top-actions">
        <a href="{{ route('home') }}" class="back-btn">
            ← Back to Products
        </a>
    </div>

    @if($news->count())
        <div class="news-container">
            @foreach($news as $item)
                <div class="news-card">
                    
                    @if($item->image)
                        <div class="img-wrapper">
                            <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}">
                        </div>
                    @endif

                    <div class="news-content">
                        <span class="category">
                            {{ $item->category?->name ?? 'General News' }}
                        </span>

                        <h2>{{ $item->title }}</h2>

                        <p>
                            {{ \Illuminate\Support\Str::limit(strip_tags($item->description), 180) }}
                        </p>

                        <div class="news-footer">
                            <span class="date">
                                📅 {{ $item->created_at->format('d M Y') }}
                            </span>
                            <a href="#" class="read-btn">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty">
            <h2>No News Available</h2>
            <p>Check back later for exciting updates and announcements.</p>
        </div>
    @endif

</body>
</html>