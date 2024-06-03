import { Pokemon } from "@/types/interfaces/backend/pokemon/Pokemon";
import PokemonListElement from "./PokemonListElement";

interface Props {
    pokemons: Pokemon[]
    selectedPokemon?: Pokemon;
    setPokemonSelected?: Function;
}

export default function PokemonList({ pokemons, selectedPokemon, setPokemonSelected }: Props) {
    return (
        <ul className="px-4 gap-4 flex flex-col">

            {pokemons.map((pokemon: Pokemon) => {
                return <PokemonListElement key={`pokemon-${pokemon.game_id}-pokemon-list`} isSelected={selectedPokemon?.game_id == pokemon.game_id} pokemon={pokemon} setPokemonSelected={setPokemonSelected} />
            })}

        </ul>
    );
}
