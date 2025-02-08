<?php

class payment
{

	public static function getPayments()
	{

		global $db;

		$total = $db->from('Payments')->select('count(*) as total')->total();

		if ($total > 0):
			
			$payments = $db->from('Payments')->all();

			if ($payments):
				
				return $payments;

			else:

				return false;

			endif;

		else:

			return false;

		endif;

	}

	public static function getPaymentInfo($data)
	{

		global $db;

		$total = $db->from('Payments')->where('id', $data)->select('count(*) as total')->total();

		if ($total > 0):
			
			$paymentInfo = $db->from('Payments')->where('id', $data)->first();

			if ($paymentInfo):
				
				return $paymentInfo;

			else:

				return false;

			endif;

		else:

			return false;

		endif;

	}

	public static function updatePayments($data)
    {

        global $db;

        $updatePayments = $db->update('Payments')->where('id', $data['id'])->set($data);

        if ($updatePayments)
            return true;
        return false;

    }

}