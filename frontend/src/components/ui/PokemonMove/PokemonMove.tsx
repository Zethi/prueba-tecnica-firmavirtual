import { Move } from "../../../types/interfaces/backend/pokemon/Move";
import PokemonType from "../PokemonType/PokemonType";
import { PokemonTypeColorsDictionary } from "../../../types/dictionarys/PokemonTypeColorsDictionary";

interface Props {
    move: Move;
}

export function PokemonMove({ move }: Props) {
    const typeColor = PokemonTypeColorsDictionary[move.type.name]

    return (
        <div
            style={{ backgroundColor: typeColor }}
            className={`rounded-3xl h-12 flex justify-between items-center px-4 w-[49%] gap-2`}>
            <PokemonType pokemonType={move.type.name} />
            <span className="text-nowrap">{move.name}</span>
            <span>PP {move.pp}/{move.pp}</span>
        </div>
    )
}