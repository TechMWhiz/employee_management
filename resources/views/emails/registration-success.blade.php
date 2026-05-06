<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration Successful</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f6f7fb; font-family: Arial, Helvetica, sans-serif; color: #111827;">
<table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f6f7fb; padding: 24px 12px;">
    <tr>
        <td align="center">
            <table role="presentation" cellpadding="0" cellspacing="0" width="600" style="width: 600px; max-width: 100%; background-color: #ffffff; border-radius: 10px; overflow: hidden; border: 1px solid #e5e7eb;">
                <tr>
                    <td style="padding: 20px 24px; background-color: #0f172a; color: #ffffff;">
                        <div style="font-size: 16px; font-weight: 700; line-height: 1.4;">Registration Successful</div>
                        <div style="font-size: 13px; opacity: 0.9; margin-top: 4px;">Welcome to {{ config('app.name') }}.</div>
                    </td>
                </tr>

                <tr>
                    <td style="padding: 20px 24px;">
                        <div style="font-size: 14px; line-height: 1.6; margin-bottom: 16px;">
                            Hi {{ $employee->name }},
                            <br>
                            Your registration was successful. Here are your details:
                        </div>

                        <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
                            <tr>
                                <td style="padding: 10px 12px; border: 1px solid #e5e7eb; background-color: #f9fafb; width: 40%; font-weight: 700;">Name</td>
                                <td style="padding: 10px 12px; border: 1px solid #e5e7eb;">{{ $employee->name }}</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px 12px; border: 1px solid #e5e7eb; background-color: #f9fafb; font-weight: 700;">Email</td>
                                <td style="padding: 10px 12px; border: 1px solid #e5e7eb;">{{ $employee->email }}</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px 12px; border: 1px solid #e5e7eb; background-color: #f9fafb; font-weight: 700;">Department</td>
                                <td style="padding: 10px 12px; border: 1px solid #e5e7eb;">{{ $employee->department ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px 12px; border: 1px solid #e5e7eb; background-color: #f9fafb; font-weight: 700;">Position</td>
                                <td style="padding: 10px 12px; border: 1px solid #e5e7eb;">{{ $employee->job_title ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px 12px; border: 1px solid #e5e7eb; background-color: #f9fafb; font-weight: 700;">Registered At</td>
                                <td style="padding: 10px 12px; border: 1px solid #e5e7eb;">{{ $registeredAt->format('Y-m-d H:i:s') }}</td>
                            </tr>
                        </table>

                        <div style="font-size: 12px; line-height: 1.6; color: #6b7280; margin-top: 16px;">
                            If you did not register, please contact support.
                        </div>
                    </td>
                </tr>

                <tr>
                    <td style="padding: 16px 24px; background-color: #f9fafb; border-top: 1px solid #e5e7eb;">
                        <div style="font-size: 12px; color: #6b7280;">
                            {{ config('app.name') }}
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
