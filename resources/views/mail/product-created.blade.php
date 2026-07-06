<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nouveau Produit Ajouté</title>
</head>
<body style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f4f5f7; padding: 20px; color: #333; line-height: 1.6;">
    <div style="max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
        
        <div style="text-align: center; margin-bottom: 30px;">
            <h1 style="color: #0A2E65; font-size: 24px; font-weight: 800; margin: 0;">KELBOM</h1>
        </div>

        <h2 style="color: #111; font-size: 20px; border-bottom: 2px solid #f0f0f0; padding-bottom: 15px; margin-bottom: 25px;">
            🛍️ Un nouveau produit vient d'être ajouté !
        </h2>
        
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 25px;">
            <tr>
                <td style="padding: 8px 0; border-bottom: 1px solid #f0f0f0;"><strong>Nom du Produit</strong></td>
                <td style="padding: 8px 0; border-bottom: 1px solid #f0f0f0; text-align: right; color: #555; font-weight: bold;">{{ $product->name }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; border-bottom: 1px solid #f0f0f0;"><strong>Prix</strong></td>
                <td style="padding: 8px 0; border-bottom: 1px solid #f0f0f0; text-align: right; color: #f59e0b; font-weight: bold;">{{ number_format($product->price, 0, ',', ' ') }} FCFA</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; border-bottom: 1px solid #f0f0f0;"><strong>Stand (Vendeur)</strong></td>
                <td style="padding: 8px 0; border-bottom: 1px solid #f0f0f0; text-align: right; color: #555;">{{ $product->seller->stand_name ?? 'Inconnu' }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; border-bottom: 1px solid #f0f0f0;"><strong>Catégorie</strong></td>
                <td style="padding: 8px 0; border-bottom: 1px solid #f0f0f0; text-align: right; color: #555;">{{ $product->category->name ?? 'Non spécifiée' }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; border-bottom: 1px solid #f0f0f0;"><strong>Statut</strong></td>
                <td style="padding: 8px 0; border-bottom: 1px solid #f0f0f0; text-align: right; color: #555;">{{ ucfirst($product->status) }}</td>
            </tr>
        </table>
        
        <div style="background-color: #f8fafc; padding: 20px; border-left: 4px solid #0A2E65; border-radius: 4px; margin-bottom: 30px;">
            <p style="margin: 0 0 8px 0; font-weight: bold; color: #111;">Description :</p>
            <p style="margin: 0; color: #555; font-size: 14px;">{{ $product->description ?? 'Aucune description fournie.' }}</p>
        </div>
        
        <div style="text-align: center;">
            <a href="{{ url('/stand/' . ($product->seller->slug ?? '')) }}" style="display: inline-block; padding: 12px 24px; background-color: #0A2E65; color: white; text-decoration: none; font-weight: bold; border-radius: 8px; font-size: 15px;">
                Voir le Produit sur le Stand
            </a>
        </div>
    </div>
</body>
</html>
