<?php

namespace AppBundle\Model;

class SuspendedProduct extends Product
{
    use ResumableProduct, DeletableProduct;
}
