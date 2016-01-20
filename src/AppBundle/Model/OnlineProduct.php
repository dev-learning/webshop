<?php

namespace AppBundle\Model;

class OnlineProduct extends Product
{
    use SuspendableProduct, DeletableProduct;
}
