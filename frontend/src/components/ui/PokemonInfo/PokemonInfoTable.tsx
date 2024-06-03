import { Pokemon } from "@/types/interfaces/backend/pokemon/Pokemon";
import PokemonInfoTableDataCell from "./PokemonInfoTableDataCell";
import PokemonType from "../PokemonType/PokemonType";
import { TypeSlot } from "@/types/interfaces/backend/pokemon/TypeSlot";

interface Props {
    pokemon: Pokemon
    className?: string;
}

export default function PokemonInfoTable({ pokemon, className }: Props) {



    return (
        <table className={`bg-white ${className} `}>
            <tbody>
                <tr>
                    <PokemonInfoTableDataCell className="w-2/4 text-center font-medium" bgColor={"var(--gray-smooth)"} >Type</PokemonInfoTableDataCell>
                    <PokemonInfoTableDataCell className="w-2/4 flex flex-row gap-2" bgColor={"var(--white-strong)"} >
                        {pokemon.types.map((typeSlot: TypeSlot) => <PokemonType pokemonType={typeSlot.type.name} key={pokemon.game_id} />)}
                    </PokemonInfoTableDataCell>
                </tr>

                <tr>
                    <PokemonInfoTableDataCell className="w-2/4 text-center font-medium" bgColor={"var(--gray-smooth)"} >Height</PokemonInfoTableDataCell>
                    <PokemonInfoTableDataCell className="w-2/4" bgColor={"var(--white-strong)"}>{pokemon.height} m. </PokemonInfoTableDataCell>
                </tr>

                <tr>
                    <PokemonInfoTableDataCell className="w-2/4 text-center font-medium" bgColor={"var(--gray-smooth)"} >Weight</PokemonInfoTableDataCell>
                    <PokemonInfoTableDataCell className="w-2/4" bgColor={"var(--white-strong)"}>{pokemon.weight} kg.</PokemonInfoTableDataCell>
                </tr>

            </tbody>
        </table>
    );
}
