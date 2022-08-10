<?php



class Invoice extends BaseModel
{
    const TABLE_NAME = 'invoice';
    function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }



    function getAll()
    {
        return $this->all();
    }
    function getInvoice($invoiceId)
    {
        return $this->search(["*"], ['id' => [$invoiceId, '=']],);
    }

    function add($userId, $name, $address, $email, $phone, $description,$total)
    {
        $result =  $this->insert([
            "userId" => $userId,
            'name' => $name,
            'address' => $address,
            'email' => $email,
            'phone' => $phone,
            'description' => $description,
            'total' => $total
        ]);

        if ($result != false) {
            return  $this->search(["*"], [
                "userId" => [$userId, "="],
                'name' => [$name, "="],
                'address' => [$address, "="],
                'email' => [$email, "="],
                'phone' => [$phone, "="],
                'description' => [$description, "="],
                'total' => [$total, "="]
            ], ["time" => 'desc'])[0];
        }
        return false;
    }

    function remove($invoiceId)
    {
        return $this->delete(['id' => $invoiceId]);
    }

    function getInvoicesByUser($userId)
    {
        return $this->search(["*"], [
            'userId' => [$userId, '=']
        ]);
    }
}
