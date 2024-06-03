import { PokemonMove } from "./PokemonMove";
import { MovesElement } from "@/types/interfaces/backend/pokemon/Pokemon";


interface Props {
    moves: MovesElement[];
    className?: string;
}

export function PokemonMoveList({ moves, className }: Props) {
    {
        return <div className={`${className} overflow-y-auto h-48 custom-scrollbar rounded-md flex flex-row flex-wrap gap-3`}>
            {moves.map((moveElement: MovesElement, index: number) => {
                return (
                    <PokemonMove key={`pokemon-move-${moveElement.move.name}`} move={moveElement.move} />
                )
            })}

        </div>
    }
}