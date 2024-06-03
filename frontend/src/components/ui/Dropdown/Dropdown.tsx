'use client';

import { useState, useEffect, useRef } from "react";

interface Props {
    children: React.ReactNode;
    title: string;
}

export function DropDown({ children, title }: Props) {
    const [isOpen, setIsOpen] = useState(false);
    const dropdownRef = useRef<HTMLDivElement>(null);

    const toggleDropdown = () => {
        setIsOpen(!isOpen);
    };

    const handleClickOutside = (event: MouseEvent) => {
        if (dropdownRef.current && !dropdownRef.current.contains(event.target as Node)) {
            setIsOpen(false);
        }
    };

    useEffect(() => {
        document.addEventListener('mousedown', handleClickOutside);
        return () => {
            document.removeEventListener('mousedown', handleClickOutside);
        };
    }, []);

    return (
        <div className="relative" ref={dropdownRef}>
            <div>
                <button
                    onClick={toggleDropdown}
                    type="button"
                    className="inline-flex justify-center items-center w-full px-4 py-2 font-medium focus:outline-none"
                    id="options-menu"
                    aria-expanded="true"
                    aria-haspopup="true"
                >
                    {title}
                    <svg className="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M5.293 7.293L9.293 11.293 13.293 7.293 14.707 8.707 9.293 14.121 3.879 8.707z" />
                    </svg>
                </button>
            </div>

            {isOpen && (
                <div className="-left-[210%] p-4 absolute z-[100] w-[300px] md:w-[500px] mt-2 rounded-md shadow-xl bg-white ring-1 text-black ring-black ring-opacity-5">
                    <div className="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                        {children}
                    </div>
                </div>
            )}
        </div>
    );
}