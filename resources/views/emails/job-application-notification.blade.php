
<!DOCTYPE html>
<html>
<head>
    <title>New Job Application</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto;">
    <div style="background: #f8f9fa; padding: 40px 20px;">
        <h1 style="color: #0ea5a4; font-size: 28px; margin-bottom: 20px;">New Job Application Received!</h1>
        
        <div style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 20px;">
            <h2 style="color: #1e293b; font-size: 22px; margin-bottom: 20px;">Application Details</h2>
            
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="padding: 12px 0; font-weight: bold; color: #6b7280;">Name:</td>
                    <td style="padding: 12px 0;">{{ $application->name }}</td>
                </tr>
                <tr>
                    <td style="padding: 12px 0; font-weight: bold; color: #6b7280;">Email:</td>
                    <td style="padding: 12px 0;"><a href="mailto:{{ $application->email }}" style="color: #0ea5a4;">{{ $application->email }}</a></td>
                </tr>
                <tr>
                    <td style="padding: 12px 0; font-weight: bold; color: #6b7280;">Phone:</td>
                    <td style="padding: 12px 0;">{{ $application->phone }}</td>
                </tr>
                <tr>
                    <td style="padding: 12px 0; font-weight: bold; color: #6b7280;">Position Applied:</td>
                    <td style="padding: 12px 0; font-weight: bold; color: #1e293b;">{{ $application->position }}</td>
                </tr>
                <tr>
                    <td style="padding: 12px 0; font-weight: bold; color: #6b7280;">IP Address:</td>
                    <td style="padding: 12px 0;">{{ $application->ip_address }}</td>
                </tr>
                <tr>
                    <td style="padding: 12px 0; font-weight: bold; color: #6b7280;">Submitted:</td>
                    <td style="padding: 12px 0;">{{ $application->created_at->format('d M Y, H:i') }}</td>
                </tr>
            </table>
        </div>
        
        @if($application->resume)
        <div style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: center;">
            <h3 style="color: #1e293b; margin-bottom: 15px;">Resume Download</h3>
            <a href="{{ asset('uploads/applications/' . $application->resume) }}" style="display: inline-block; background: #0ea5a4; color: white; padding: 12px 24px; text-decoration: none; border-radius: 8px; font-weight: bold;" target="_blank">
                📎 Download Resume
            </a>
        </div>
        @endif
        
        <div style="text-align: center; margin-top: 30px; padding-top: 30px; border-top: 1px solid #e5e7eb;">
            <p style="color: #6b7280; font-size: 14px;">
                Regards,<br>
                <strong>Regret Consultancy Team</strong>
            </p>
        </div>
    </div>
</body>
</html>

