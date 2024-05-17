<?php

// BOISSON
interface BoissonInterface {
	public function cout(): float;
}

class Boisson implements BoissonInterface {
	public function cout(): float {
		return 2.0;
	}
}

// DECORATEURS
class BoissonDecorateur implements BoissonInterface {
	public function __construct(private BoissonInterface $boisson) {
		
	}
	
	public function cout(): float {
		return $this->boisson->cout();
	}
}

class LaitDecorateur extends BoissonDecorateur {
	public function cout(): float {
		
		return parent::cout() + 0.5;
	}
}

class SucreDecorateur extends BoissonDecorateur {
	public function cout(): float {
		
		return parent::cout() + 0.25;
	}
}

class ChantillyDecorateur extends BoissonDecorateur {
	public function cout(): float {
		
		return parent::cout() + 5;
	}	
}

// CODE CLIENT
class GenerateBoissonPrice {
	
	public function renderBoissonLaitEtSucrePrice(): float {
		$boisson = new Boisson();
	
		$boissonAvecLait = new LaitDecorateur($boisson);
		$boissonAvecLaitEtSucre = new SucreDecorateur($boissonAvecLait);
		
		return $boissonAvecLaitEtSucre->cout();
	}
	
	public function renderBoissonSucrePrice(): float {
		$boisson = new Boisson();
	
		$boissonAvecSucre = new SucreDecorateur($boisson);
		
		return $boissonAvecSucre->cout();
	}
}

$boissonPriceGenerator = new GenerateBoissonPrice();

$boissonLaiEtSucrePrice = $boissonPriceGenerator->renderBoissonLaitEtSucrePrice();
var_dump('le prix de la boisson avec lait et sucre est de : ', $boissonLaiEtSucrePrice);

$boissonLaitPrice = $boissonPriceGenerator->renderBoissonSucrePrice();
var_dump('le prix de la boisson avec sucre est de : ', $boissonLaitPrice);
