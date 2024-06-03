import React from "react";

interface Props {
    bgColor: string;
    className?: string;
    children: React.ReactNode;
}

export default function PokemonInfoTableDataCell({ bgColor, className, children }: Props) {

    return (
        <td
            style={{ backgroundColor: bgColor }}
            className={`${className} px-4 py-2`}>{children}</td>
    );
}
