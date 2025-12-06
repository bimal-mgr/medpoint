<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MedPoint</title>
  <link rel="icon" type="image/png" href="public/med-logo.png">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Edu+NSW+ACT+Cursive:wght@400..700&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
  </style>
  <style type="text/tailwindcss">
    body{
      background: #f8f9fa;
    }
    @theme {
  --font-heading: "Inter";
  --font-logo: "Edu NSW ACT Cursive";
  --color-med-lime: #28A745;
  --color-ash: #E4E4E4;
  --color-txt-ash: #666666;
  --color-bdr-ash: #CECECE;
  --color-med-drklime: #304D30;
  --color-main-green: #044343;
  --color-main-gray: #BDC3C6;
  --color-main-black: #263238;
}
@layer base{
  button{
   cursor: pointer;
  }
}
@layer utilities {
  @keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
  }

  .animate-fadeIn {
    animation: fadeIn 0.4s ease-out forwards;
  }
}
@layer components{
   .share{
       border: 2px solid var(--color-med-lime);
       transition: all 0.3s ease;
   }
   .btn {
       padding: 14px 32px;
       border: none;
       border-radius: 8px;
       font-size: 16px;
       font-weight: 600;
       transition: all 0.3s;
   }
   .hero::before {
       content: '';
       position: absolute;
       top: -50%;
       right: -10%;
       width: 500px;
       height: 500px;
       background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><circle cx="100" cy="100" r="80" fill="%23ffffff" opacity="0.1"/></svg>');
       background-size: contain;
   }
   .feature-card {
       background: white;
       padding: 24px;
       border-radius: 12px;
       box-shadow: 0 4px 12px rgba(0,0,0,0.1);
       text-align: center;
       transition: transform 0.3s;
   }
   .feature-card:hover {
       transform: translateY(-5px);
   }

   .feature-icon {
       font-size: 40px;
       margin-bottom: 12px;
   }

   .feature-card h3 {
       font-size: 18px;
       margin-bottom: 8px;
       color: #00796b;
   }

   .feature-card p {
       font-size: 14px;
       color: #666;
   }
}
    </style>
</head>
