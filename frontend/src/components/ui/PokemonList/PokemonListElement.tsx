'use client';

import Link from "next/link";
import Image from "next/image";
import { Pokemon } from "@/types/interfaces/backend/pokemon/Pokemon";
import { addLeadingZeros, capitalizeFirstLetter } from "@/utils/StringUtils";
import { useState } from "react";
import PokemonType from "../PokemonType/PokemonType";

interface Props {
    isSelected?: boolean;
    pokemon: Pokemon
    setPokemonSelected?: Function;
}

export default function PokemonListElement({ isSelected = false, pokemon, setPokemonSelected }: Props) {
    const [hoverTimeout, setHoverTimeout] = useState<NodeJS.Timeout | null>(null);

    const backgroundGradient = 'linear-gradient(120deg, var(--orange-strong) 50%, var(--black-strong) 50%)';

    function handleOnMouseEnter(): void {
        if (setPokemonSelected != undefined) {
            if (hoverTimeout) {
                clearTimeout(hoverTimeout);
            }
            const timeout = setTimeout(() => {
                setPokemonSelected(pokemon);
            }, 220);
            setHoverTimeout(timeout);
        }
    }

    function handleOnMouseLeave(): void {
        if (hoverTimeout) {
            clearTimeout(hoverTimeout);
            setHoverTimeout(null);
        }
    }

    return (
        <li
            style={{
                background: isSelected ? backgroundGradient : ""
            }}
            onMouseEnter={handleOnMouseEnter}
            onMouseLeave={handleOnMouseLeave}
            className={`rounded-3xl w-full h-9 ${isSelected ? 'shadow-2xl' : ''} ${isSelected ? 'opacity-100' : 'opacity-75'}  text-sm font-semibold pokemon-list-element hover:shadow-lg  hover:text-white `}
        >
            <Link href={`/pokemon/${pokemon.game_id}`} prefetch={false} className="grid grid-cols-[1fr_2fr] xl:grid-cols-2 h-full items-center">
                <div className="relative px-4 flex items-center">
                    <div className="absolute left-2">
                        <Image src={`https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/${pokemon.game_id}.png`} alt={`pokemon-${pokemon.name}-sprite`} width={40} height={40} />
                    </div>
                    <span className={`ml-8 ${isSelected ? 'text-white' : ''}`}>No. {addLeadingZeros(pokemon.game_id)}</span>
                </div>

                <div className="px-4 flex justify-between items-center">
                    <span className={`${isSelected ? 'text-white' : ''}`}>{capitalizeFirstLetter(pokemon.name)}</span>

                    <div className="flex gap-2 flex-row">
                        {pokemon.types.map((type, index) => {
                            return <PokemonType pokemonType={type.type.name} key={`pokmemon-type-list-${pokemon.game_id}-${index}`} />
                        })}
                    </div>
                </div>
            </Link>
        </li>
    );
}