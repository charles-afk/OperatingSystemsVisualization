import sys

input = open("input.txt", "r") # open input file
lines = input.readlines() # read input file lines
input.close()
temp = []
index = 0

# remove newlines
for line in lines:
    new_line = line.replace("\n", "")
    temp.append(new_line)
    index += 1

lines = temp
index = 0
n_slots = int(lines[index]) # get number of free memory slots
index += 1
slots = []

# get free memory slots
for x in range(n_slots):
    slot = lines[index].split(" ")
    slots.append([int(slot[0]), int(slot[1]), None])
    index += 1

n_processes = int(lines[index]) # get number of processes
index += 1
processes = []

# get processes
for x in range(n_processes):
    process = lines[index].split(" ");
    processes.append([int(process[0]), int(process[1])])
    index += 1

# check if memory slot is free
def slot_is_free(slot):
    return slot[2] == None

def slot_size(slot):
    return slot[1] - slot[0]

# check if process fits in memory slot
def process_does_fit(process, slot):
    return process[1] < slot_size(slot)


# allocate memory slot to process
def allocate(process, slot):
    slot[2] = process


# generate output file
def generate_output():
    output_str = ""
    for slot in slots:
        if slot[2] != None:
            output_str += str(slot[0]) + " " + str(slot[0] + slot[2][1]) + " " + str(slot[2][0]) + "\n"
    output = open("output.txt", "w")
    output.write(output_str)
    output.close()


# allocate processes using first fit
def allocate_first_fit():
    for process in processes:
        for slot in slots:
            if slot_is_free(slot) and process_does_fit(process, slot):
                allocate(process, slot)
                break
    generate_output()

# allocate processes using best fit
def allocate_best_fit():
    for process in processes:
        best_fit = None
        for slot in slots:
            if slot_is_free(slot) and process_does_fit(process, slot):
                if not best_fit:
                    best_fit = slot
                elif slot_size(slot) < slot_size(best_fit):
                    best_fit = slot
        if best_fit:
            allocate(process, best_fit)
    generate_output()

# allocate processes using worst fit
def allocate_worst_fit():
    for process in processes:
        worst_fit = None
        for slot in slots:
            if slot_is_free(slot) and process_does_fit(process, slot):
                if not worst_fit:
                    worst_fit = slot
                elif slot_size(slot) > slot_size(worst_fit):
                    worst_fit = slot
        if worst_fit:
            allocate(process, worst_fit)
    generate_output()


method = sys.argv[1]

if (method == "first_fit"):
    allocate_first_fit()
if (method == "best_fit"):
    allocate_best_fit()
elif (method == "worst_fit"):
    allocate_worst_fit()