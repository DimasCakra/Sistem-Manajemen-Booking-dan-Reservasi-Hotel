<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Instrument Sans', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-r from-[#172554] via-[#1E40AF] to-[#172554] text-[#1E40AF] min-h-screen">

<div class="flex flex-col justify-center min-h-screen py-8 px-6">
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTE5hirGcGYW4VJKa63FFemb3xfb23CdjNJlg&s" 
         alt="Logo" 
         class="block mx-auto mb-[30px] max-w-[80px] h-auto rounded-full aspect-square object-cover border border-black shadow-lg-800">

    <div class="bg-white p-8 rounded-[1.25rem] shadow-[0_10px_30px_rgba(15,23,42,0.08)] border border-black w-full max-w-[400px] mx-auto shadow-lg-800">
        <form action="{{ url('/register') }}" method="GET">
            <h2 class="text-base font-bold mb-5 uppercase text-[#1E40AF]tracking-[0.5px]">
                Register for an Account
            </h2>

            <div class="mb-[1.2rem]">
                <label for="name" class="block text-[0.8rem] font-semibold text-[#1E40AF] mt-[2px]">
                    FULL NAME
                </label>
                <input id="name" type="text" name="name" required autocomplete="name"
                    class="w-full rounded-[0.6rem] bg-white border border-black py-[0.7rem] px-[0.9rem] text-[0.95rem] text-[#0A0F1C] 
                           transition-all duration-200 focus:outline-none focus:border-[#2563EB] focus:ring-[3px] focus:ring-[#2563EB]/12">
            </div>

            <div class="mb-[1.2rem]">
                <label for="email" class="block text-[0.8rem] font-semibold text-[#1E40AF] mt-[2px]">
                    Email address
                </label>
                <input id="email" type="email" name="email" required autocomplete="email"
                    class="w-full rounded-[0.6rem] bg-white border border-black py-[0.7rem] px-[0.9rem] text-[0.95rem] text-[#0A0F1C] 
                           transition-all duration-200 focus:outline-none focus:border-[#2563EB] focus:ring-[3px] focus:ring-[#2563EB]/12">
            </div>

            <div class="mb-[1.2rem]">
                <label for="whatsapp" class="block text-[0.8rem] font-semibold text-[#1E40AF] mt-[2px]">
                    WhatsApp Number
                </label>
                <input id="whatsapp" type="text" name="whatsapp" required autocomplete="whatsapp"
                    class="w-full rounded-[0.6rem] bg-white border border-black py-[0.7rem] px-[0.9rem] text-[0.95rem] text-[#0A0F1C] 
                           transition-all duration-200 focus:outline-none focus:border-[#2563EB] focus:ring-[3px] focus:ring-[#2563EB]/12">
            </div>

            <div class="mb-[1.2rem]">
                <label for="password" class="block text-[0.8rem] font-semibold text-[#1E40AF] mt-[2px]">
                    Password
                </label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                    class="w-full rounded-[0.6rem] bg-white border border-black py-[0.7rem] px-[0.9rem] text-[0.95rem] text-[#0A0F1C] 
                           transition-all duration-200 focus:outline-none focus:border-[#2563EB] focus:ring-[3px] focus:ring-[#2563EB]/12">
            </div>
        
            <div class="mt-6">
                <button type="submit" 
                        class="w-full bg-[#2563EB] text-white p-[0.75rem] rounded-[0.6rem] font-semibold 
                               transition-all duration-200 hover:bg-[#1D4ED8] active:scale-[0.98]">
                    Register
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>