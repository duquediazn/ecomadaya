<?php
declare(strict_types=1);

use PHPMailer\PHPMailer\Exception as PHPMailerException;
use PHPMailer\PHPMailer\PHPMailer;

/**
 * Envia correo de contacto mediante PHPMailer + SMTP autenticado.
 *
 * @param string $toEmail
 * @param string $subject
 * @param string $body
 * @param string $replyToEmail
 * @return array{ok: bool, error: string}
 */
function madayaSendContactMailSmtp(string $toEmail, string $subject, string $body, string $replyToEmail): array
{
    if (!MADAYA_SMTP_ENABLED) {
        return ['ok' => false, 'error' => 'smtp_disabled'];
    }

    if (
        MADAYA_SMTP_HOST === ''
        || MADAYA_SMTP_USERNAME === ''
        || MADAYA_SMTP_PASSWORD === ''
        || MADAYA_SMTP_FROM_EMAIL === ''
    ) {
        return ['ok' => false, 'error' => 'smtp_config_incomplete'];
    }

    $encryption = match (MADAYA_SMTP_ENCRYPTION) {
        'ssl' => PHPMailer::ENCRYPTION_SMTPS,
        'none' => '',
        default => PHPMailer::ENCRYPTION_STARTTLS,
    };

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = MADAYA_SMTP_HOST;
        $mail->Port = MADAYA_SMTP_PORT;
        $mail->SMTPAuth = MADAYA_SMTP_AUTH;
        $mail->Username = MADAYA_SMTP_USERNAME;
        $mail->Password = MADAYA_SMTP_PASSWORD;
        $mail->Timeout = MADAYA_SMTP_TIMEOUT;
        $mail->CharSet = 'UTF-8';
        $mail->SMTPDebug = (APP_ENV === 'development') ? MADAYA_SMTP_DEBUG : 0;

        if ($encryption !== '') {
            $mail->SMTPSecure = $encryption;
        }

        $mail->setFrom(MADAYA_SMTP_FROM_EMAIL, MADAYA_SMTP_FROM_NAME);
        $mail->addAddress($toEmail);
        $mail->addReplyTo($replyToEmail);

        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->isHTML(false);

        $mail->send();

        return ['ok' => true, 'error' => ''];
    } catch (PHPMailerException $e) {
        error_log('[contacto][smtp] PHPMailer error: ' . $e->getMessage());
        return ['ok' => false, 'error' => 'smtp_send_failed'];
    }
}
