<?php

abstract class Service extends CApplicationComponent
{
    protected function useSession($sessionID)
    {
        Yii::app()->session->close();
        Yii::app()->session->setSessionID($sessionID);
        Yii::app()->session->open();
    }
}