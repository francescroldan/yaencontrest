<?php

namespace App\Command;

use App\Domain\OwnerRepository;
use App\Domain\AdvertisementRepository;
use Symfony\Component\Console\Command\Command;
use App\Application\Create\AdvertisementCreator;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Application\Create\CreateAdvertisementCommand;
use App\Tests\Advertisement\Domain\AdvertisementMockFactory;
use App\Application\Create\CreateAdvertisementCommandHandler;

class PopulateDBCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:populate';
    private $advertisementRepository;
    private $ownerRepository;

    public function __construct(AdvertisementRepository $advertisementRepository, OwnerRepository $ownerRepository)
    {
        $this->advertisementRepository = $advertisementRepository;
        $this->ownerRepository = $ownerRepository;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->addArgument('number', InputArgument::REQUIRED, 'Number of advertisements created.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!is_numeric($input->getArgument('number'))) {
            $output->writeln(['Argument must be a valid number']);
            return 0;
        }

        $advertisementCreator = new AdvertisementCreator($this->advertisementRepository, $this->ownerRepository);
        $createAdvertisementCommandHandler = new CreateAdvertisementCommandHandler($advertisementCreator);
        $output->writeln(['Trying to create ' . $input->getArgument('number') . ' advertisementes.']);

        for ($i = 0; $i < $input->getArgument('number'); $i++) {
            $expectedAdvertisement = AdvertisementMockFactory::GenerateRandom();
            $createAdvertisementCommand = new CreateAdvertisementCommand;
            $createAdvertisementCommand->__invoke(
                $expectedAdvertisement->title()->value(),
                $expectedAdvertisement->description()->value(),
                $expectedAdvertisement->price()->value(),
                $expectedAdvertisement->locality()->value(),
                $expectedAdvertisement->owner()->__toArray()
            );

            $createAdvertisementCommandHandler($createAdvertisementCommand);
            $output->writeln(['Advertisement ' . ($i + 1) . ' created.']);
        }
        $output->writeln(['The creation has finished successfully.']);


        return 1;
    }
}
