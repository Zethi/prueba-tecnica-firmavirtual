import PokemonList from "@/components/ui/PokemonList/PokemonList";
import Loader from "@/components/ui/utils/Loader";
import { Pokemon } from "@/types/interfaces/backend/pokemon/Pokemon";

interface Props {
    pokemons: Pokemon[]
    selectedPokemon?: Pokemon;
    setPokemonSelected: Function;
}

export default function HomePokemonListSection({ pokemons, selectedPokemon, setPokemonSelected }: Props) {


    return (
        <div className="max-h-[70vh] w-full mx-3 2xl:mx-4 bg-white p-4 rounded-2xl text-black shadow-2xl relative">
            {pokemons.length < 1 ? <div className="absolute z-50 top-[44%] left-[48%]">
                <Loader color="#000000" className="w-[36px] h-[36px]" />
            </div> : <></>}
            <div className="overflow-y-auto overflow-x-hidden custom-scrollbar max-h-[68vh] ">
                <PokemonList pokemons={pokemons ?? []} setPokemonSelected={setPokemonSelected} selectedPokemon={selectedPokemon} />
            </div>
        </div>
    );
}
