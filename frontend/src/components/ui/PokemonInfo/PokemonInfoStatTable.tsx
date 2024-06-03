import { Pokemon } from "@/types/interfaces/backend/pokemon/Pokemon";
import PokemonInfoTableDataCell from "./PokemonInfoTableDataCell";
import { Stat } from "@/types/interfaces/backend/pokemon/Stat";
import { PokemonStatNamesDictionary } from "@/types/dictionarys/PokemonStatNamesDictionary";

interface Props {
    pokemon: Pokemon
    className?: string;
}

export default function PokemonInfoStatTable({ pokemon, className }: Props) {



    return (
        <table className={`bg-white  ${className} `}>
            <tbody>
                {pokemon.stats.map((stat: Stat) => {
                    return (

                        <tr key={pokemon.game_id}>
                            <PokemonInfoTableDataCell className="w-2/4 text-center font-medium" bgColor={"var(--gray-smooth)"} >{PokemonStatNamesDictionary[stat.stat.name].toUpperCase()}</PokemonInfoTableDataCell>
                            <PokemonInfoTableDataCell className="w-2/4 flex flex-row gap-2" bgColor={"var(--white-strong)"} >{stat.base}</PokemonInfoTableDataCell>
                        </tr>
                    )
                })}

            </tbody>
        </table>
    );
}
