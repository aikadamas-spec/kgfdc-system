<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maombi ya Kujiunga - Fomu ya Malipo</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .form-container { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        h2 { text-align: center; color: #333; }
        .info-box { background: #e7f3ff; padding: 10px; border-radius: 5px; margin-bottom: 20px; font-size: 14px; color: #0056b3; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background-color: #28a745; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; font-weight: bold; }
        button:hover { background-color: #218838; }
        .footer-note { text-align: center; font-size: 12px; color: #777; margin-top: 15px; }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Anza Maombi Hapa</h2>
    
    <div class="info-box">
        Ada ya fomu ya usajili ni <strong>TSH 15,000</strong>. Malipo yatafanyika kwa Mobile Money.
    </div>

    <form action="{{ route('apply.pay') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Jina Kamili</label>
            <input type="text" name="name" id="name" placeholder="Mfn: Juma Hamis" required>
        </div>

        <div class="form-group">
            <label for="phone">Namba ya Simu (Malipo)</label>
            <input type="text" name="phone" id="phone" placeholder="Mfn: 07XXXXXXXX" required>
        </div>

        <button type="submit">Lipia na Fungua Fomu</button>
    </form>

    <div class="footer-note">
        Ukibonyeza "Lipia", utapokea ujumbe wa malipo kwenye simu yako.
    </div>
</div>

</body>
</html>
