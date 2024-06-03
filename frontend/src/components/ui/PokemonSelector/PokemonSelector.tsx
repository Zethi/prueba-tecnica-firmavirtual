import { Pokemon } from "@/types/interfaces/backend/pokemon/Pokemon";
import { capitalizeFirstLetter } from "@/utils/StringUtils";

interface Props {
    pokemon: Pokemon
    className?: string;
}

export default function PokemonSelector({ pokemon, className }: Props) {



    return (
        <div className={`${className} w-full flex justify-center`}>
            <div
                style={{
                    background: 'linear-gradient(120deg, var(--orange-strong) 34.9%, var(--black-strong) 35%)'
                }}
                className="w-[83%] h-14 grid grid-cols-[1fr_2fr] text-white"
            >
                <div className="w-full flex justify-center flex-col px-4 text-lg">
                    <span>No. {pokemon.game_id}</span>
                </div>

                <div className="w-full flex justify-center flex-col font-bold text-2xl px-6">
                    <span>{capitalizeFirstLetter(pokemon.name)}</span>
                </div>

            </div>
        </div>
    );
}
