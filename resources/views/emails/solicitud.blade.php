<!DOCTYPE html>
<html lang="es">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"></head>
<body style="margin:0;background:#0f0f16;font-family:Arial,Helvetica,sans-serif;color:#e8e0d4;">
  <div style="max-width:600px;margin:0 auto;padding:24px;">
    <div style="background:#1a1722;border:1px solid rgba(212,175,55,0.35);border-radius:14px;overflow:hidden;">
      <div style="background:linear-gradient(135deg,#8b7536,#d4af37);color:#18120a;padding:16px 22px;">
        <h1 style="margin:0;font-size:18px;">Nueva solicitud de reservación</h1>
        <p style="margin:4px 0 0;font-size:13px;">Puebla Legendaria — recibida desde el sitio web</p>
      </div>
      <div style="padding:22px;">
        <table style="width:100%;border-collapse:collapse;font-size:14px;">
          <tr><td style="padding:8px 0;color:#9a9a9a;width:150px;">Nombre</td><td style="padding:8px 0;">{{ $solicitud->nombre }}</td></tr>
          <tr><td style="padding:8px 0;color:#9a9a9a;">Correo</td><td style="padding:8px 0;"><a href="mailto:{{ $solicitud->email }}" style="color:#f0d060;">{{ $solicitud->email }}</a></td></tr>
          <tr><td style="padding:8px 0;color:#9a9a9a;">Teléfono</td><td style="padding:8px 0;"><a href="tel:{{ $solicitud->telefono }}" style="color:#f0d060;">{{ $solicitud->telefono }}</a></td></tr>
          <tr><td style="padding:8px 0;color:#9a9a9a;">Recorrido de interés</td><td style="padding:8px 0;">{{ $solicitud->recorrido ?: '—' }}</td></tr>
          <tr><td style="padding:8px 0;color:#9a9a9a;">Número de personas</td><td style="padding:8px 0;">{{ $solicitud->personas ?: '—' }}</td></tr>
        </table>
        <div style="margin-top:16px;padding:14px;background:rgba(255,255,255,0.04);border-left:3px solid #d4af37;border-radius:8px;">
          <div style="color:#9a9a9a;font-size:12px;margin-bottom:6px;">Mensaje</div>
          <div style="white-space:pre-wrap;font-size:14px;">{{ $solicitud->mensaje ?: '—' }}</div>
        </div>
        <p style="margin:18px 0 0;font-size:12px;color:#9a9a9a;">
          Puedes responder directamente a este correo para contestarle a {{ $solicitud->nombre }}.
        </p>
      </div>
    </div>
  </div>
</body>
</html>
