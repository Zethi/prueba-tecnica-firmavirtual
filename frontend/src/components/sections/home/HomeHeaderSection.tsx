import Loader from "@/components/ui/utils/Loader";
import { Pokemon } from "@/types/interfaces/backend/pokemon/Pokemon";
import Image from "next/image";
import HomeHeaderFilterSection from "./HomeHeaderFIlterSection";

interface Props {
    pokemons: Pokemon[]
    setPokemonList: Function;
    setSelectedPokemon: Function;
}

export default function HomeHeaderSection({ pokemons, setPokemonList, setSelectedPokemon }: Props) {


    return (
        <header className="w-full">
            <div
                style={
                    { background: 'linear-gradient(120deg, var(--orange-strong) 50%, var(--black-strong) 50%)' }
                }
                className="my-3 h-16 items-center px-8 grid grid-cols-2 text-white shadow-xl"
            >
                <div className="flex justify-between items-center">
                    <h1 className="hidden lg:block font-bold text-3xl text-white">Pokédex</h1>

                    <div className="rounded-lg bg-black md:mr-48 px-5 py-1 flex gap-[0.3rem] items-center">
                        <Image src={"/assets/pokemon/icons/pokeball.png"} alt="pokeball-icon" width={28} height={28} />
                        {pokemons.length > 1 ? pokemons.length : <Loader color="#ffffff" />}
                    </div>
                </div>

                <div className="items-center flex justify-center">
                    <HomeHeaderFilterSection pokemons={pokemons} setPokemonList={setPokemonList} setSelectedPokemon={setSelectedPokemon} />
                </div>
            </div>
        </header >


    );
}
