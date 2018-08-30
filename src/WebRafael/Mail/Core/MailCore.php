<?php

namespace Mail\Core;

use Mail\Services\StartMail;

class MailCore
{
    protected $mail;

    public function __construct()
    {
        $this->mail = StartMail::build();
    }

    /**
     * buildMail
     *
     * @return void
     */
    public function buildMail()
    {
        try {
            return $this->mail->Send();
        }catch(\Exception $e){
            return $e;
        }
    }

    /**
     * subject
     *
     * @param  string $subject
     * @return void
     */
    public function subject(string $subject = null)
    {
        $this->mail->Subject = $subject;
        return $this;
    }

    /**
     * from
     *
     * @param  string $mail
     * @param  string $name
     * @return void
     */
    public function from(string $mail = null, string $name = null)
    {
        $this->mail->SetFrom($mail, $name, false);
        $this->mail->AddReplyTo($mail, $name);
        return $this;
    }

    /**
     * to
     *
     * @param  string $mail
     * @param  string $name
     * @return void
     */
    public function to($mail = null, $name = null)
    {
        $this->toMail = $mail;
        $this->toName = $name;

        if(!is_array($mail)) {
            $this->mail->addReplyTo($this->toMail, $this->toName);
            $this->mail->AddAddress($this->toMail, $this->toName);
        } else {
            foreach((array) $mail as $item) {
                $this->mail->addReplyTo($item['mail'], $item['name']);
                $this->mail->AddAddress($item['mail'], $item['name']);
            }
        }

        return $this;
    }

    /**
     * file
     *
     * @param string $path
     * @param string $file
     * @return void
     */
    public function file(string $path = null, string $file = null)
    {
        if((!is_null($path)) || (!is_null($file))) {
            $this->mail->AddAttachment($path, $file);
        }
        
        return $this;
    }

    /**
     * text
     *
     * @param  string $string
     * @return void
     */
    public function text(string $string)
    {
        $this->mail->Body = $string;
        return $this;
    }

    /**
     * body
     *
     * @param string  $string
     * @param boolean $template
     * @param boolean $response
     * @return void
     */
    public function body(string $string, $template = false, $response = false)
    {
        $this->mail->Body = $string;
        return $this;
    }

    public function send()
    {
        return $this->buildMail();
    }
}